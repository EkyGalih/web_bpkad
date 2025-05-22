<?php

namespace App\Http\Controllers\LKPD\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLkpdController extends Controller
{
    public function index()
    {
        return view('lkpd.beranda.beranda');
    }
}
