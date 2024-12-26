<?php

namespace App\Helpers;

use App\Models\Lkpd\Apbd as LkpdApbd;

class Apbd
{
    // ================================
    //              APBD
    // ===============================

    public static function GetApbdTahun($TahunAnggaran, $KodeRekening)
    {
        $apbd = LkpdApbd::select('jml_anggaran_setelah', 'kode_rekening', 'nama_rekening', 'tahun_anggaran')
            ->where('kode_rekening', '=', $KodeRekening)
            ->where('tahun_anggaran', '=', $TahunAnggaran)
            ->first();
        return $apbd;
    }

    public static function SumSubAPBD($TahunAnggaran, $KodeRekening)
    {

        $Apbd = LkpdApbd::where('tahun_anggaran', '=', $TahunAnggaran)
                    ->where('kode_rekening', 'LIKE', $KodeRekening.'%')
                    ->select('jml_anggaran_setelah','kode_rekening')
                    ->get();
        $sum = [];

        foreach ($Apbd as $item) {
            if (strlen($item->kode_rekening) > 3) {
                array_push($sum, $item->jml_anggaran_setelah);
            }
        }

        return array_sum($sum);
    }

    public static function GetSumSubAPBD($TahunAnggaran, $KodeRekening)
    {
        $Apbd = LkpdApbd::select('jml_anggaran_setelah','kode_rekening', 'nama_rekening', 'tahun_anggaran')
                ->where('tahun_anggaran', '=', $TahunAnggaran)
                ->where('kode_rekening', 'LIKE', $KodeRekening.'%')
                ->orderBy('tahun_anggaran', 'ASC')
                ->get();

        $sum = [];

        foreach ($Apbd as $item) {
            if (strlen($item->kode_rekening) > 3) {
                array_push($sum, $item->jml_anggaran_setelah);
            }
        }

        return array_sum($sum);
    }
}
