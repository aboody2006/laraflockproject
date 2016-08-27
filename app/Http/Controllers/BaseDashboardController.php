<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;

use Laraflock\Dashboard\Controllers\BaseDashboardController as LaraflockBaseDashboardController;

class BaseDashboardController extends LaraflockBaseDashboardController
{
    use ValidatesRequests;
}
