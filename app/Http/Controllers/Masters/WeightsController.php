<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Models\Weight;
use App\Models\Product;
use App\Models\Unit;

use App\Http\Controllers\BaseDashboardController;
use Maatwebsite\Excel\Facades\Excel;

class WeightsController extends BaseDashboardController
{

    public function index()
    {
        $weights = Weight::with('unit', 'product')->get();
        return view('dashboard.weights.index', ['weights' => $weights]);
    }

    public function create()
    {
        $units = Unit::lists('title', 'id');
        return view('dashboard.weights.create', ['units' => $units]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'full_weight' => 'numeric',
            'half_weight' => 'numeric',
            'unit'        => 'required|exists:units,id',
            'product'     => 'required',
        ]);

        $product = Product::firstOrCreate(['title' => $request->product]);

        $weight = new Weight();
        $weight->fill($request->all());

        $weight->product()->associate($product);
        $weight->unit()->associate($request->unit);

        $weight->save();

        Flash::success('New weight for product ' . $weight->product->title . ' was added');
        return redirect()->route('weights.index');
    }

    public function show($id)
    {
        if (!$weight = Weight::with('unit', 'product')->find($id)) {
            Flash::error('Weight not found');
            return redirect()->route('weights.index');
        }

        return view('dashboard.weights.show', ['weight' => $weight]);
    }

    public function edit($id)
    {
        if (!$weight = Weight::with('product')->find($id)) {
            Flash::error('Weight not found');
            return redirect()->route('weights.index');
        }

        $units = Unit::lists('title', 'id');

        return view('dashboard.weights.edit', ['weight' => $weight, 'units' => $units]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'full_weight' => 'numeric',
            'half_weight' => 'numeric',
            'unit'        => 'required|exists:units,id',
            'product'     => 'required',
        ]);

        if (!$weight = Weight::find($id)) {
            Flash::error('Weight not found');
            return redirect()->route('weights.index');
        }

        $product = Product::firstOrCreate(['title' => $request->product]);

        $weight->fill($request->all());

        $weight->product()->associate($product);
        $weight->unit()->associate($request->unit);

        $weight->save();

        Flash::success('Weight for product ' . $weight->product->title . ' was updated');
        return redirect()->route('weights.index');
    }

    public function productSearch(Request $request)
    {
        return Product::doesntHave('weight')
            ->whereRaw('LOWER(title) like LOWER(?)', ['%' . $request->q . '%'])
            ->limit(10)->get()->lists('title', 'id');
    }

    public function exportWeights()
    {
        return Excel::create('weights', function ($excel) {

            $excel->sheet('Weights', function ($sheet) {
                $weights = Weight::all();
                $arr = [];
                foreach ($weights as $weight) {
                    $data = array(
                        $weight->id,
                        $weight->product->id,
                        $weight->product->title,
                        $weight->unit->id,
                        $weight->unit->title,
                        $weight->full_weight,
                        $weight->half_weight,
                        ($weight->full_weight + $weight->half_weight) / 2,
                    );
                    array_push($arr, $data);

                }
                //set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'Weight ID',
                        'Product ID',
                        'Product Title',
                        'Unit ID',
                        'Unit Title',
                        'Full Weight',
                        'Half Weight',
                        'Average',
                    )

                );
            });

        })->export('xlsx');
    }

    public function importWeights()
    {
        return view("dashboard.weights.import");
    }

    public function importWeightsPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Weights") {
            Flash::error('The file you uploaded is not Weights exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $weight = Weight::findOrNew($value->weight_id);
                $weight->product_id = $value->product_id;
                $weight->unit_id = $value->unit_id;
                $weight->full_weight = $value->full_weight;
                $weight->half_weight = $value->half_weight;
                $weight->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('weights.index');
    }

}
