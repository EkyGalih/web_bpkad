<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\AsetTIK;
use App\Models\Bidang;
use App\Models\LokasiAset;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LokasiAsetController extends Controller
{

    public function index()
    {
        $lokasiAset = LokasiAset::groupBy('pegawai_id')->get();
        return view('inventaris.lokasi-aset.index', compact('lokasiAset'));
    }

    public function create($id = null)
    {
        $asets      = AsetTIK::all();
        $bidangs    = Bidang::all();
        $pegawais   = Pegawai::all();

        if ($id == null) {
            $aset = new AsetTIK();
            return view('inventaris.lokasi-aset.partials.add', compact('aset', 'asets', 'bidangs', 'pegawais'));
        } else {
            $aset = AsetTIK::findOrFail($id);
            return view('inventaris.lokasi-aset.partials.add', compact('aset', 'asets', 'bidangs', 'pegawais'));
        }
    }

    public function store(Request $request)
    {
        $cek_aset = Helpers::countAsetDistribusi($request->aset_id);
        $aset_tik = AsetTIK::where('id', $request->aset_id)->value('jumlah');

        if ($cek_aset == $aset_tik) {
            session()->flash('error', 'Jumlah aset yang sudah di distribusi sudah mencapai jumlah aset pada data aset');
            return redirect()->route('inventaris.lokasi.create');
        } else {
            LokasiAset::create($request->all());

            session()->flash('success', 'Lokasi Aset berhasil ditambahkan');
            return redirect()->route('inventaris.lokasi.index');
        }
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
