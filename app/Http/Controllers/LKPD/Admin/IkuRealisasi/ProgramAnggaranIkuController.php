<?php

namespace App\Http\Controllers\Admin\IkuRealisasi;

use App\Helper\UserAccess;
use App\Http\Controllers\Controller;
use App\Models\ProgramAnggaran;
use Illuminate\Http\Request;

class ProgramAnggaranIkuController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProgramAnggaran::create([
            'program' => $request->program,
            'anggaran' => UserAccess::CurrencyConvertComa($request->anggaran),
            'anggaran_terpakai' => 0,
            'persentase_anggaran' => 0,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('iku-realisasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $ProgramAnggaran = ProgramAnggaran::findOrFail($id);

        $getPersentase = (UserAccess::CurrencyConvertComa($request->anggaran_terpakai) / UserAccess::CurrencyConvertComa($request->anggaran)) * 100;

        $ProgramAnggaran->update([
            'anggaran_terpakai' => UserAccess::CurrencyConvertComa($request->anggaran_terpakai),
            'persentase_anggaran' => $getPersentase
        ]);


        return redirect()->route('iku-realisasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ProgramAnggaran = ProgramAnggaran::findOrFail($id);
        $ProgramAnggaran->delete();

        return redirect()->route('iku-realisasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
