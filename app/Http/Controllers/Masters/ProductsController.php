<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Product;
use App\Models\Section;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends BaseDashboardController
{

    public function index()
    {
        $products = Product::with('section', 'section.category')->get();
        return view('dashboard.products.index', ['products' => $products]);
    }

    public function create()
    {
        $sections = Section::lists('title', 'id');
        return view('dashboard.products.create', ['sections' => $sections]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'    => 'required',
            'title'   => 'required|unique:products,title',
            'section' => 'required|exists:sections,id'
        ]);

        $product = new Product();
        $product->fill($request->all());
        $product->section()->associate($request->section);
        $product->save();

        Flash::success('New product ' . $product->title . ' was added');
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        if (!$product = Product::with('section', 'section.category')->find($id)) {
            Flash::error('Product not found');
            return redirect()->route('products.index');
        }

        return view('dashboard.products.show', ['product' => $product]);
    }

    public function edit($id)
    {
        if (!$product = Product::with('section')->find($id)) {
            Flash::error('Product not found');
            return redirect()->route('products.index');
        }

        $sections = Section::lists('title', 'id');

        return view('dashboard.products.edit', ['product' => $product, 'sections' => $sections]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code'    => 'required',
            'title'   => 'required|unique:products,title',
            'section' => 'required|exists:sections,id'
        ]);

        if (!$product = Product::find($id)) {
            Flash::error('Product not found');
            return redirect()->route('products.index');
        }

        $product->fill($request->all());
        $product->section()->associate($request->section);
        $product->save();

        Flash::success('Product ' . $product->title . ' was updated');
        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if (!$product = Product::find($id)) {
            Flash::error('Product not found');
            return redirect()->route('products.index');
        }
        if (count($product->characteristic)) {
            Flash::error('Product has characteristic,please delete characteristic to can delete prodcut');
            return redirect()->route('products.index');
        }
        if (count($product->orders)) {
            Flash::error('Product has orders,please delete orders to can delete prodcut');
            return redirect()->route('products.index');
        }
        $product->delete();

        Flash::success('Product ID#' . $product->id . ' was deleted');
        return redirect()->route('products.index');
    }

    /**
     * @return mixed
     */
    public function exportProducts()
    {
        return Excel::create('products', function ($excel) {

            $excel->sheet('Products', function ($sheet) {
                $products = Product::all();
                $arr = [];
                foreach ($products as $product) {
                    $data = array(
                        $product->id,
                        $product->title,
                        $product->code,
                        $product->section->id,
                        $product->section->title,
                        $product->section->category->id,
                        $product->section->category->title
                    );
                    array_push($arr, $data);

                }
                //set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'Product ID',
                        'Product Title',
                        'Product Code',
                        'Section ID',
                        'Section Title',
                        'Category ID',
                        'Category Title'
                    )

                );
            });

        })->export('xlsx');
    }

    public function importProducts()
    {
        return view("dashboard.products.import");
    }

    public function importProductsPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Products") {
            Flash::error('The file you uploaded is not Products exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $product = Product::findOrNew($value->product_id);
                $product->code = $value->product_code;
                $product->title = $value->product_title;
                $product->section_id = $value->section_id;
                $product->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('products.index');
    }
}