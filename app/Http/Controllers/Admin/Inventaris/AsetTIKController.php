<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\AsetTIK;
use App\Models\KategoriAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetTIKController extends Controller
{
    public function index()
    {
        $asets = AsetTIK::paginate(10);

        return view('inventaris.aset-tik.index', compact('asets'));
    }

    public function create()
    {
        $kategories = KategoriAset::all();
        return view('inventaris.aset-tik.partials.add', compact('kategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|mimes:jpg,png,jpeg|max:2048', // rules: hanya menerima file jpg, png, pdf dengan ukuran maksimum 2MB
        ]);

        $file = $request->file('gambar');
        $path = $file->store('uploads/aset', 'public');
        $url = Storage::url($path);

        $rupiah = preg_replace('/[^\d]/', '', $request['nilai']); // format rupiah ke integer

        AsetTIK::create([
            'nama_aset' => $request->nama_aset,
            'kode_aset' => $request->kode_aset,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'type' => $request->type,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'status' => $request->status,
            'nilai' => $rupiah,
            'jumlah' => $request->jumlah,
            'gambar' => $url,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('inventaris.aset.index')->with('success', 'Data berhasil di simpan');
    }

    public function edit($id)
    {
        $aset = AsetTIK::findOrFail($id);
        $kategories = KategoriAset::all();

        return view('inventaris.aset-tik.partials.edit', compact('aset', 'kategories'));
    }

    public function update(Request $request, $id)
    {
        $data = AsetTIK::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('inventaris.aset.index')->with('success', 'Data berhasil di update');
    }

    public function destroy($id)
    {
        $data = AsetTIK::findOrFail($id);
        $data->delete();
        return redirect()->route('inventaris.aset.index')->with('success', 'Data berhasil di hapus');
    }
}
