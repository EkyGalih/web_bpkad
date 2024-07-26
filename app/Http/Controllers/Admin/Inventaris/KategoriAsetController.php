<?php

namespace App\Http\Controllers\Admin\Inventaris;

use App\Http\Controllers\Controller;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    public function index()
    {
        $kategories = KategoriAset::paginate(10);

        return view('inventaris.kategori.index', compact('kategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriAset::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('inventaris.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = KategoriAset::find($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('inventaris.kategori.index')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $kategori = KategoriAset::find($id);
        $kategori->delete();

        return redirect()->route('inventaris.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
