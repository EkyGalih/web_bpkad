<?php

namespace App\Helpers;

use App\Models\Lkpd\FileIku;
use App\Models\Lkpd\IndikatorKinerja;
use App\Models\Lkpd\ProgramAnggaran;
use App\Models\Lkpd\SasaranStrategis;
use App\Models\Lkpd\SubKegiatanIku;

// ================================
//          IKU REALISASI
// ===============================
class Iku
{
    public static function GetSasaran()
    {
        $tahun = date('Y');
        return SasaranStrategis::select('id as sasaran_id', 'sasaran_strategis.*')->where('created_at', 'LIKE', $tahun . '%')->get();
    }

    public static function GetIK()
    {
        $tahun = date('Y');
        return IndikatorKinerja::select('id as ik_id', 'indikator_kinerja.indikator_kinerja')->where('created_at', 'LIKE', $tahun . '%')->get();
    }

    public static function GetProgramAnggaran()
    {
        $years = date('Y');
        return ProgramAnggaran::select('id as program_anggaran_id', 'program_anggaran_iku.*')
            ->where('created_at', 'LIKE', $years . '%')
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public static function GetSubKegiatanAll($kode_kegiatan)
    {
        return SubKegiatanIku::where('kode_kegiatan_iku', '=', $kode_kegiatan)->get();
    }

    public static function GetSubKegiatan($kode_kegiatan)
    {
        return SubKegiatanIku::where('kode_kegiatan_iku', '=', $kode_kegiatan)->first();
    }

    public static function GetPersentase($kode_kegiatan)
    {
        $persentase = SubKegiatanIku::where('kode_kegiatan_iku', '=', $kode_kegiatan)->select('persentase')->first();
        return $persentase->persentase;
    }

    public static function GetAllPersentase($kode_kegiatan)
    {
        $persentases   = SubKegiatanIku::where('kode_kegiatan_iku', '=', $kode_kegiatan)->select('persentase')->count();
        $persentase    = SubKegiatanIku::where('kode_kegiatan_iku', '=', $kode_kegiatan)->where('persentase', '=', 100)->select('persentase')->count();

        return round(($persentase / $persentases) * 100, 2);
    }

    public static function GetListFile($id)
    {
        $file = FileIku::where('sub_kegiatan_iku_id', '=', $id)->select('nama_file')->paginate(10);
        return $file;
    }
}
