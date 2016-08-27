<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

class CategoriesController extends BaseDashboardController
{

    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $category = new Category();
        $category->fill($request->all());
        $category->save();

        Flash::success('New category ' . $category->title . ' was added');
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        if (!$category = Category::find($id)) {
            Flash::error('Category not found');
            return redirect()->route('categories.index');
        }

        return view('dashboard.categories.show', ['category' => $category]);
    }

    public function edit($id)
    {
        if (!$category = Category::find($id)) {
            Flash::error('Category not found');
            return redirect()->route('categories.index');
        }

        return view('dashboard.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        if (!$category = Category::find($id)) {
            Flash::error('Category not found');
            return redirect()->route('categories.index');
        }

        $category->fill($request->all());
        $category->save();

        Flash::success('Category ' . $category->title . ' was updated');
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        if (!$category = Category::find($id)) {
            Flash::error('Category not found');
            return redirect()->route('categories.index');
        }
        if (count($category->sections)) {
            Flash::error('Category Contains Some sections,please delete sections to can delete category');
            return redirect()->route('categories.index');
        }

        $category->delete();

        Flash::success('Category ID#' . $category->id . ' was deleted');
        return redirect()->route('categories.index');
    }

    /**
     * @return mixed
     */
    public function exportCategories()
    {
        $data = Category::get()->toArray();
        return Excel::create('categories', function ($excel) use ($data) {
            $excel->sheet('Categories', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download("xlsx");
    }

    public function importCategories()
    {
        return view("dashboard.categories.import");
    }

    /**
     * @param ImportRequest $importRequest
     */
    public function importCategoriesPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Categories") {
            Flash::error('The file you uploaded is not categories exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $characteristic = Category::findOrNew($value->id);
                $characteristic->title = $value->title;
                $characteristic->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('categories.index');
    }
}
