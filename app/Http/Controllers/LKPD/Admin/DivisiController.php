<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Divisi = Divisi::select('id as divisi_id', 'divisi.*')->paginate(10);
        return view('admin.Divisi.divisi', compact('Divisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Divisi::create([
            'kode_divisi' => 'BPKAD-'.$request->alias_divisi.uniqid(),
            'nama_divisi' => $request->nama_divisi,
            'alias_divisi' => $request->alias_divisi
        ]);

        return redirect()->route('admin-divisi')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Divisi = Divisi::findOrFail($id);
        $Divisi->update([
            'nama_divisi' => $request->nama_divisi,
            'alias_divisi' => $request->alias_divisi
        ]);

        return redirect()->route('admin-divisi')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Divisi = Divisi::findOrFail($id);
        $Divisi->delete();

        return redirect()->route('admin-divisi')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
