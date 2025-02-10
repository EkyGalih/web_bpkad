<?php

namespace App\Http\Controllers\Simpeg\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminSimpegController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::orderBy('updated_at', 'DESC')->paginate(6);
        return view('SimPeg.beranda.beranda', compact('pegawai'));
    }
}
