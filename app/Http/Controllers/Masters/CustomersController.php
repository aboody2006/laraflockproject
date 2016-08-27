<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends BaseDashboardController
{

    public function index()
    {
        $customers = Customer::all();
        return view('dashboard.customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('dashboard.customers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|string'
        ]);

        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();

        Flash::success('New customer ' . $customer->company . ' was added');
        return redirect()->route('customers.index');
    }

    public function show($id)
    {
        if (!$customer = Customer::find($id)) {
            Flash::error('Customer not found');
            return redirect()->route('customers.index');
        }

        return view('dashboard.customers.show', ['customer' => $customer]);
    }

    public function edit($id)
    {
        if (!$customer = Customer::find($id)) {
            Flash::error('Customer not found');
            return redirect()->route('customers.index');
        }

        return view('dashboard.customers.edit', ['customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company' => 'required|string',
        ]);

        if (!$customer = Customer::find($id)) {
            Flash::error('Customer not found');
            return redirect()->route('customers.index');
        }

        $customer->fill($request->all());
        $customer->save();

        Flash::success('Customer ' . $customer->company . ' was updated');
        return redirect()->route('customers.index');
    }

    public function delete($id)
    {
        if (!$customer = Customer::find($id)) {
            Flash::error('Customer not found');
            return redirect()->route('customers.index');
        }

        $customer->delete();

        Flash::success('Customer ID#' . $customer->id . ' was deleted');
        return redirect()->route('customers.index');
    }

    /**
     * @return mixed
     */
    public function exportCustomers()
    {
        $data = Customer::get()->toArray();
        return Excel::create('customer', function ($excel) use ($data) {
            $excel->sheet('Customers', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download("xlsx");
    }

    public function importCustomers()
    {
        return view("dashboard.customers.import");
    }

    /**
     * @param ImportRequest $importRequest
     * @return mixed
     */
    public function importCustomersPost(ImportRequest $importRequest)
    {
        $path = $importRequest->file('file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get();
        if ($data->getTitle() <> "Customers") {
            Flash::error('The file you uploaded is not Customers exported file');
            return redirect()->back();
        }

        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $customers = Customer::findOrNew($value->id);
                $customers->company = $value->company;

                $customers->save();
            }
        }
        Flash::success(trans("characteristics.importedSucc"));

        return redirect()->route('customers.index');
    }
}
