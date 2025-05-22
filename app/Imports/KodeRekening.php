<?php

namespace App\Imports;

use App\Models\Lkpd\KodeRekening as ModelsKodeRekening;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Webpatser\Uuid\Uuid;

class KodeRekening implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            ModelsKodeRekening::create([
                'id' => Uuid::generate(4),
                'kode_rekening' => $row['kode_rekening'],
                'nama_rekening' => $row['nama_rekening'],
                'ref'           => $row['ref']
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
