<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Godown;
use Maatwebsite\Excel\Facades\Excel;

class GodownsController extends BaseDashboardController
{

    public function index()
    {
        $godowns = Godown::all();
        return view('dashboard.godowns.index', ['godowns' => $godowns]);
    }

    public function create()
    {
        return view('dashboard.godowns.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $godown = new Godown();
        $godown->fill($request->all());
        $godown->save();

        Flash::success('New godown ' . $godown->name . ' was added');
        return redirect()->route('godowns.index');
    }

    public function show($id)
    {
        if (!$godown = Godown::find($id)) {
            Flash::error('Godown not found');
            return redirect()->route('godowns.index');
        }

        return view('dashboard.godowns.show', ['godown' => $godown]);
    }

    public function edit($id)
    {
        if (!$godown = Godown::find($id)) {
            Flash::error('Godown not found');
            return redirect()->route('godowns.index');
        }

        return view('dashboard.godowns.edit', ['godown' => $godown]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        if (!$godown = Godown::find($id)) {
            Flash::error('Godown not found');
            return redirect()->route('godowns.index');
        }

        $godown->fill($request->all());
        $godown->save();

        Flash::success('Godown ' . $godown->name . ' was updated');
        return redirect()->route('godowns.index');
    }

    public function delete($id)
    {
        if (!$godown = Godown::find($id)) {
            Flash::error('Godown not found');
            return redirect()->route('godowns.index');
        }

        $godown->delete();

        Flash::success('Godown ' . $godown->name . ' was deleted');
        return redirect()->route('godowns.index');
    }

    /**
     * @return mixed
     */
    public function exportGodowns()
    {
        $data = Godown::get()->toArray();
        return Excel::create('godown', function ($excel) use ($data) {
            $excel->sheet('Godowns', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download("xlsx");

    }

    public function importGodowns()
    {
        return view("dashboard.godowns.import");
    }

    public function importGodownsPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Godowns") {
            Flash::error('The file you uploaded is not Godowns exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $godowns = Godown::findOrNew($value->id);
                $godowns->name = $value->name;
                $godowns->address = $value->address;
                $godowns->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('godowns.index');
    }
}
