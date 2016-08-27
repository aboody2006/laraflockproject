<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Section;
use Maatwebsite\Excel\Facades\Excel;

class SectionsController extends BaseDashboardController
{

    public function index()
    {
        $sections = Section::with('category')->get();
        return view('dashboard.sections.index', ['sections' => $sections]);
    }

    public function create()
    {
        $categories = Category::lists('title', 'id');
        return view('dashboard.sections.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required|exists:categories,id'
        ]);

        $section = new Section();
        $section->fill($request->all());
        $section->category()->associate($request->category);
        $section->save();

        Flash::success('New section ' . $section->title . ' was added');
        return redirect()->route('sections.index');
    }

    public function show($id)
    {
        if (!$section = Section::with('category')->find($id)) {
            Flash::error('Section not found');
            return redirect()->route('sections.index');
        }

        return view('dashboard.sections.show', ['section' => $section]);
    }

    public function edit($id)
    {
        if (!$section = Section::with('category')->find($id)) {
            Flash::error('Section not found');
            return redirect()->route('sections.index');
        }

        $categories = Category::lists('title', 'id');

        return view('dashboard.sections.edit', ['section' => $section, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required|exists:categories,id'
        ]);

        if (!$section = Section::find($id)) {
            Flash::error('Section not found');
            return redirect()->route('sections.index');
        }

        $section->fill($request->all());
        $section->category()->associate($request->category);
        $section->save();

        Flash::success('Section ' . $section->title . ' was updated');
        return redirect()->route('sections.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if (!$section = Section::find($id)) {
            Flash::error('Section not found');
            return redirect()->route('sections.index');
        }
        if (count($section->products)) {
            Flash::error('Section Contains Some products,please delete products to can delete section');
            return redirect()->route('sections.index');
        }

        $section->delete();

        Flash::success('Section ID#' . $section->id . ' was deleted');
        return redirect()->route('sections.index');
    }

    /**
     * @return mixed
     */
    public function exportSections()
    {
        return Excel::create('sections', function ($excel) {

            $excel->sheet('Sections', function ($sheet) {
                $sections = Section::all();
                $arr = [];
                foreach ($sections as $section) {
                    $data = array($section->id, $section->title, $section->category->id, $section->category->title);
                    array_push($arr, $data);

                }
                //set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'Section ID',
                        'Section Title',
                        'Category ID',
                        'Category Title'
                    )

                );
            });

        })->export('xlsx');
    }

    public function importSections()
    {
        return view("dashboard.sections.import");
    }

    public function importSectionsPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Sections") {
            Flash::error('The file you uploaded is not Sections exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $section = Section::findOrNew($value->section_id);
                $section->title = $value->section_title;
                $section->category_id = $value->category_id;
                $section->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('sections.index');
    }
}
