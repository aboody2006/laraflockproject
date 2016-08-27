<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Unit;
use Maatwebsite\Excel\Facades\Excel;

class UnitsController extends BaseDashboardController
{

    public function index()
    {
        $units = Unit::all();
        return view('dashboard.units.index', ['units' => $units]);
    }

    public function create()
    {
        return view('dashboard.units.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'required|alpha_dash',
            'symbol' => 'required|alpha_dash'
        ]);

        $unit = new Unit();
        $unit->fill($request->all());
        $unit->save();

        Flash::success('New unit ' . $unit->title . ' was added');
        return redirect()->route('units.index');
    }

    public function show($id)
    {
        if (!$unit = Unit::find($id)) {
            Flash::error('Unit not found');
            return redirect()->route('units.index');
        }

        return view('dashboard.units.show', ['unit' => $unit]);
    }

    public function edit($id)
    {
        if (!$unit = Unit::find($id)) {
            Flash::error('Unit not found');
            return redirect()->route('units.index');
        }

        return view('dashboard.units.edit', ['unit' => $unit]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'  => 'required|alpha_dash',
            'symbol' => 'required|alpha_dash'
        ]);

        if (!$unit = Unit::find($id)) {
            Flash::error('Unit not found');
            return redirect()->route('units.index');
        }

        $unit->fill($request->all());
        $unit->save();

        Flash::success('Unit ' . $unit->title . ' was updated');
        return redirect()->route('units.index');
    }

    public function delete($id)
    {
        if (!$unit = Unit::find($id)) {
            Flash::error('Unit not found');
            return redirect()->route('units.index');
        }

        $unit->delete();

        Flash::success('Unit ' . $unit->title . ' was deleted');
        return redirect()->route('units.index');
    }

    public function exportUnits()
    {
        $data = Unit::get()->toArray();
        return Excel::create('units', function ($excel) use ($data) {
            $excel->sheet('Units', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download("xlsx");
    }

    public function importUnits()
    {
        return view("dashboard.units.import");
    }

    public function importUnitsPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Units") {
            Flash::error('The file you uploaded is not Units exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $unit = Unit::findOrNew($value->id);
                $unit->title = $value->title;
                $unit->symbol = $value->symbol;
                $unit->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));
        return redirect()->route('units.index');
    }
}
