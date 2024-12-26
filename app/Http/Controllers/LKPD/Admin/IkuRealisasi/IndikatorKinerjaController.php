<?php

namespace App\Http\Controllers\Admin\IkuRealisasi;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerja;
use Illuminate\Http\Request;

class IndikatorKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indikatorKinerja = IndikatorKinerja::select('id as ik_id', 'indikator_kinerja.indikator_kinerja')->paginate(10);
        return view('admin.iku_realisasi.Components.indikator-kinerja', compact('indikatorKinerja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        IndikatorKinerja::create(['indikator_kinerja' => $request->indikator_kinerja]);

        return redirect()->route('iku-indikator')->with(['success' => 'Data berhasil disimpan!']);
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
        $indikatorKinerja = IndikatorKinerja::findOrFail($id);
        $indikatorKinerja->update(['indikator_kinerja' => $request->indikator_kinerja]);

        return redirect()->route('iku-indikator')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indikatorKinerja = IndikatorKinerja::findOrFail($id);
        $indikatorKinerja->delete();

        return redirect()->route('iku-indikator')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
