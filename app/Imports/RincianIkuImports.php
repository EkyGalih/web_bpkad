<?php

namespace App\Imports;

use App\Models\Bidang;
use App\Models\FileIku;
use App\Models\Lkpd\IndikatorKinerja;
use App\Models\Lkpd\KegiatanIku;
use App\Models\Lkpd\ProgramAnggaran;
use App\Models\Lkpd\SubKegiatanIku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RincianIkuImports implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // ambil data untuk relasi
            $divisi_id = Bidang::where('kode_divisi', '=', $row['kode_divisi'])->select('id')->first();
            $program_id = ProgramAnggaran::where('kode_program', '=', $row['program'])->select('id')->first();
            $indikator_id = IndikatorKinerja::where('kode_indikator', '=', $row['indikator_sasaran'])->select('id')->first();

            KegiatanIku::create([
                'nama_kegiatan'         => $row['kegiatan'],
                'kode_kegiatan'         => $row['kode_kegiatan'],
                'divisi_id'             => $divisi_id->id,
                'program_iku_id'        => $program_id->id,
                'indikator_kinerja_id'  => $indikator_id->id,
                'tahun'                 => date('Y')
            ]);

            SubKegiatanIku::create([
                'sub_kegiatan'          => $row['sub_kegiatan'],
                'indikator_kinerja'     => $row['indikator_kinerja'],
                'target_kinerja'        => $row['target_kinerja'],
                'kode_kegiatan_iku'     => $row['kode_kegiatan']
            ]);

        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
