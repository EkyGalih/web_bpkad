<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\LaporanRealisasiAnggaran;
use Illuminate\Http\Request;

class RealisasiAnggaranController extends Controller
{
    public function subTotal1($ref1, $ref2, $tahun)
    {
        $subTotal = LaporanRealisasiAnggaran::where('ref1', '=', $ref1)->where('ref2', '=', $ref2)->where('tahun_anggaran', '=', $tahun)
        ->sum('anggaran');
        return $subTotal;
    }

    public function subTotal2($ref1, $ref2, $tahun)
    {
        $subTotal = LaporanRealisasiAnggaran::where('ref1', '=', $ref1)->where('ref2', '=', $ref2)->where('tahun_anggaran_sebelum', '=', $tahun)
        ->sum('realisasi_anggaran');
        return $subTotal;
    }

    public function subTotal3($ref1, $ref2, $tahun)
    {
        $subTotal = LaporanRealisasiAnggaran::where('ref1', '=', $ref1)->where('ref2', '=', $ref2)->where('tahun_anggaran_sebelum', '=', $tahun)
        ->sum('realisasi_anggaran_sebelum');
        return $subTotal;
    }

    public function Total1($tahun)
    {
        $total = LaporanRealisasiAnggaran::where('tahun_anggaran', '=', $tahun)
        ->sum('anggaran');
        return $total;
    }

    public function Total2($tahun)
    {
        $total = LaporanRealisasiAnggaran::where('tahun_anggaran_sebelum', '=', $tahun)
        ->sum('realisasi_anggaran');
        return $total;
    }

    public function Total3($tahun)
    {
        $total = LaporanRealisasiAnggaran::where('tahun_anggaran_sebelum', '=', $tahun)
        ->sum('realisasi_anggaran_sebelum');
        return $total;
    }
}
