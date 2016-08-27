<?php

namespace App\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseDashboardController;
use Laracasts\Flash\Flash;
use App\Models\Transactions\PackingSlip;

class PackingController extends BaseDashboardController
{
    public function index()
    {
//        $packingSlips = PackingSlip::all();

        return view('dashboard.transactions.packing.index');
    }

    public function createPackingSlip()
    {
        return view('dashboard.transactions.packing.create');
    }

    public function savePackingSlip()
    {

    }
}