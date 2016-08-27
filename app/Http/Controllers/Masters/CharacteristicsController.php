<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Models\Characteristic;

use App\Http\Controllers\BaseDashboardController;
use Maatwebsite\Excel\Facades\Excel;

class CharacteristicsController extends BaseDashboardController
{

    public function index()
    {
        $characteristics = Characteristic::with('product')->get();
        return view('dashboard.characteristics.index', ['characteristics' => $characteristics]);
    }

    public function create()
    {
        return view('dashboard.characteristics.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'length'  => 'alpha_num',
            'product' => 'required',
        ]);

        $product = Product::firstOrCreate(['title' => $request->product]);

        $characteristic = new Characteristic();
        $characteristic->fill($request->all());

        $characteristic->product()->associate($product);
        $characteristic->save();

        Flash::success('New characteristic ' . $characteristic->title . ' was added');
        return redirect()->route('characteristics.index');
    }

    public function show($id)
    {
        if (!$characteristic = Characteristic::with('product')->find($id)) {
            Flash::error('Characteristic not found');
            return redirect()->route('characteristics.index');
        }

        return view('dashboard.characteristics.show', ['characteristic' => $characteristic]);
    }

    public function edit($id)
    {
        if (!$characteristic = Characteristic::with('product')->find($id)) {
            Flash::error('Characteristic not found');
            return redirect()->route('characteristics.index');
        }

        return view('dashboard.characteristics.edit', ['characteristic' => $characteristic]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'length'  => 'alpha_num',
            'product' => 'required',
        ]);

        if (!$characteristic = Characteristic::find($id)) {
            Flash::error('Characteristic not found');
            return redirect()->route('characteristics.index');
        }

        $product = Product::firstOrCreate(['title' => $request->product]);

        $characteristic->fill($request->all());
        $characteristic->product()->associate($product);
        $characteristic->save();

        Flash::success('Characteristic ' . $characteristic->title . ' was updated');
        return redirect()->route('characteristics.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if (!$characteristic = Characteristic::find($id)) {
            Flash::error('Characteristic not found');
            return redirect()->route('characteristics.index');
        }

        $characteristic->delete();

        Flash::success('Characteristic ID#' . $characteristic->id . ' was deleted');
        
        return redirect()->route('characteristics.index');
    }

    /**
     * @return mixed
     */
    public function exportCharacteristics()
    {
        return Excel::create('Technicals characteristics', function ($excel) {

            $excel->sheet('Technicals characteristics', function ($sheet) {
                $characteristics = Characteristic::all();
                $arr = [];
                foreach ($characteristics as $characteristic) {
                    $data = array(
                        $characteristic->id,
                        $characteristic->product->id,
                        $characteristic->product->title,
                        $characteristic->length,
                    );
                    array_push($arr, $data);

                }
                //set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'Technicals characteristics ID',
                        'Product ID',
                        'Product Title',
                        'Length',
                    )

                );
            });

        })->export('xlsx');
    }

    public function importCharacteristics()
    {
        return view('dashboard.characteristics.import');
    }

    /**
     * @param ImportRequest $importRequest
     */
    public function inportCharacteristicsPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Technicals characteristics") {
            Flash::error('The file you uploaded is not Technicals characteristics exported file');
            return redirect()->back();
        }
        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $characteristic = Characteristic::findOrNew($value->technicals_characteristics_id);
                $characteristic->product_id = $value->product_id;
                $characteristic->length = $value->length;
                $characteristic->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('characteristics.index');
    }

    public function productSearch(Request $request)
    {
        return Product::doesntHave('characteristic')
            ->whereRaw('LOWER(title) like LOWER(?)', ['%' . $request->q . '%'])
            ->limit(10)->get()->lists('title', 'id');
    }
}
