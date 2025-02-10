<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Formulasi;
use Illuminate\Http\Request;

class IkuRealisasiController extends Controller
{
    public function getFormulasi($id)
    {
        $formulasi = Formulasi::join('divisi', 'formulasi.divisi_id', '=', 'divisi.id')
            ->select(
                'formulasi.id as formula_id',
                'formulasi.formulasi',
                'formulasi.tipe_penghitungan',
                'divisi.id as divisi_id',
                'divisi.nama_divisi'
                )
            ->where('indikator_kinerja_id', '=', $id)
            ->first();
        return response()->json($formulasi);
    }

    public function formulaDetail($id)
    {
        $formulasi = Formulasi::join('divisi', 'formulasi.divisi_id', '=', 'divisi.id')
        ->join('iku_realisasi', 'formulasi.id', '=', 'iku_realisasi.formula_id')
            ->select(
                'formulasi.id as formula_id',
                'formulasi.formulasi',
                'formulasi.tipe_penghitungan',
                'divisi.id as divisi_id',
                'divisi.nama_divisi',
                'iku_realisasi.target'
                )
            ->where('iku_realisasi.indikator_kinerja_id', '=', $id)
            ->first();
        return response()->json($formulasi);
    }
}
