<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\LokasiAset;
use Illuminate\Http\Request;

class LokasiAsetController extends Controller
{

    public function index()
    {
        $lokasiAset = LokasiAset::orderBy('created_at', 'desc')->paginate(10);
        return view('inventaris.lokasi-aset.index', compact('lokasiAset'));
    }

    public function create()
    {
        return view('admin.inventaris.lokasi-aset.create');
    }

    public function store(Request $request)
    {
        LokasiAset::create($request->all());
        return redirect()->route('admin.inventaris.lokasi-aset.index');
    }

    public function edit($id)
    {
        $lokasiAset = LokasiAset::find($id);
        return view('admin.inventaris.lokasi-aset.edit', compact('lokasiAset'));
    }

    public function update(Request $request, $id)
    {
        $lokasiAset = LokasiAset::find($id);
        $lokasiAset->update($request->all());
        return redirect()->route('admin.inventaris.lokasi-aset.index');
    }

    public function destroy($id)
    {
        $lokasiAset = LokasiAset::find($id);
        $lokasiAset->delete();
        return redirect()->route('admin.inventaris.lokasi-aset.index');
    }
}
