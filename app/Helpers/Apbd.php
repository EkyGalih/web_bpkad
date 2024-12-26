<?php

namespace App\Helpers;

use App\Models\Lkpd\Apbd as LkpdApbd;
use App\Models\Lkpd\KodeRekening;
use App\Models\Lkpd\LaporanRealisasiAnggaran;

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
            ->where('kode_rekening', 'LIKE', $KodeRekening . '%')
            ->select('jml_anggaran_setelah', 'kode_rekening')
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
        $Apbd = LkpdApbd::select('jml_anggaran_setelah', 'kode_rekening', 'nama_rekening', 'tahun_anggaran')
            ->where('tahun_anggaran', '=', $TahunAnggaran)
            ->where('kode_rekening', 'LIKE', $KodeRekening . '%')
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

    public static function GetKodeRekening()
    {
        return KodeRekening::select('id', 'kode_rekening', 'nama_rekening')->orderBy('kode_rekening', 'ASC')->get();
    }

    public static function GetSubKode()
    {
        $KodeRekening = [
            "kode_rekening" => array(),
            "nama_rekening" => array()
        ];
        $Get = KodeRekening::select('id', 'kode_rekening', 'nama_rekening')->orderBy('kode_rekening', 'ASC')->get();

        foreach ($Get as $item) {
            if (strlen($item->kode_rekening) > 3) {
                array_push($KodeRekening["kode_rekening"], $item->kode_rekening);
                array_push($KodeRekening["nama_rekening"], $item->nama_rekening);
            }
        }
        return $KodeRekening;
    }

    public static function SumSubLRA($kode_rekening)
    {
        return LaporanRealisasiAnggaran::where('kode_rekening', 'Like', $kode_rekening . '%')
            ->select('anggaran_terealisasi')
            ->sum('anggaran_terealisasi');
    }
}
