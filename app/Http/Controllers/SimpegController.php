<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SimpegController extends Controller
{
    public function index()
    {
        return Inertia::render('Main', []);
    }
}
