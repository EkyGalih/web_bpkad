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
        $asets = AsetTIK::orderBy('created_at', 'DESC')->paginate(10);

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
            'gambar' => 'required|mimes:jpg,png,jpeg|max:5120', // rules: hanya menerima file jpg, png, pdf dengan ukuran maksimum 5MB
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
            'merek' => $request->merek,
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

    public function detail($id)
    {
        $aset = AsetTIK::findOrFail($id);
        return view('inventaris.aset-tik.partials.detail', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|mimes:jpg,png,jpeg|max:2048', // rules: hanya menerima file jpg, png, jpeg dengan ukuran maksimum 2MB
        ]);

        $asetTIK = AsetTIK::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($asetTIK->gambar) {
                // Get the old file path from the URL
                $oldFilePath = str_replace('/storage/', '', $asetTIK->gambar);
                Storage::disk('public')->delete($oldFilePath);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $path = $file->store('uploads/aset', 'public');
            $url = Storage::url($path);
        } else {
            $url = $asetTIK->gambar;
        }

        // Format rupiah ke integer
        $rupiah = preg_replace('/[^\d]/', '', $request->nilai);

        $asetTIK->update([
            'nama_aset' => $request->nama_aset,
            'kode_aset' => $request->kode_aset,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'merek' => $request->merek,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'status' => $request->status,
            'nilai' => $rupiah,
            'jumlah' => $request->jumlah,
            'gambar' => $url,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('inventaris.aset.index')->with('success', 'Aset berhasil diupdate');
    }

    public function destroy($id)
    {
        $asetTIK = AsetTIK::findOrFail($id);

        // Delete the image file if it exists
        if ($asetTIK->gambar) {
            $oldFilePath = str_replace('/storage/', '', $asetTIK->gambar);
            Storage::disk('public')->delete($oldFilePath);
        }

        // Delete the asset record from the database
        $asetTIK->delete();
        return redirect()->route('inventaris.aset.index')->with('success', 'Data berhasil di hapus');
    }
}
