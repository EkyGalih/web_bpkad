<?php

namespace App\Http\Controllers\Admin\IkuRealisasi;

use App\Http\Controllers\Controller;
use App\Models\Formulasi;
use App\Models\IndikatorKinerja;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Formulasi = Formulasi::select('id as formula_id', 'formulasi.*')->paginate(10);

        return view('admin.iku_realisasi.Components.formula', compact('Formulasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Formulasi::create([
            'indikator_kinerja_id' => $request->indikator_kinerja_id,
            'formulasi' => $request->formulasi,
            'tipe_penghitungan' => $request->tipe_penghitungan,
            'divisi_id' => $request->divisi_id,
            'alasan' => $request->alasan
        ]);

        return redirect()->route('iku-formulasi')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $Formulasi = Formulasi::findOrFail($id);

        $Formulasi->update([
            'indikator_kinerja_id' => $request->indikator_kinerja_id,
            'formulasi' => $request->formulasi,
            'tipe_penghitungan' => $request->tipe_penghitungan,
            'divisi_id' => $request->divisi_id,
            'alasan' => $request->alasan
        ]);

        return redirect()->route('iku-formulasi')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Formulasi = Formulasi::findOrFail($id);
        $Formulasi->delete();
        return redirect()->route('iku-formulasi')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
