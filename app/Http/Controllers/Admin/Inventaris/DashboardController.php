<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('inventaris.dashboard.index');
    }
}
