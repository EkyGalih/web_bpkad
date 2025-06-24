<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Webpatser\Uuid\Uuid;

class Pegawai extends Model
{
    use HasFactory;

    protected $connection = 'simpeg';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $table = 'pegawai';
    public $incrementing = false;
    protected $guarded = ['createdAt', 'updatedAt'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Uuid::generate(4);
            }
        });
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'pegawai_id', 'id');
    }

    public function PPIDStruktur()
    {
        return $this->hasOne(PPIDStruktur::class);
    }

    public function lokasiAssets()
    {
        return $this->hasMany(LokasiAset::class, 'pegawai_id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function hitungKenaikanPangkatDanTanggalSK()
    {
        // Parsing masa kerja (misalnya 1 thn 1 bln menjadi total bulan)
        $masaKerja = $this->parseMasaKerja($this->masa_kerja_golongan);

        // Tentukan tanggal pertama kali SK (misalnya jika kosong maka default)
        $tanggalSK = $this->tanggal_sk ?: $this->tanggal_masuk;

        // Tentukan tahun kenaikan pangkat berikutnya
        $nextKenaikanPangkat = $this->tentukanKenaikanPangkat($masaKerja, $tanggalSK);

        return [
            'kenaikan_pangkat' => $nextKenaikanPangkat['kenaikan_pangkat'],
            'tanggal_sk' => $nextKenaikanPangkat['tanggal_sk']
        ];
    }

    // Fungsi untuk memparse masa kerja dalam format '1 thn 1 bln' menjadi bulan
    private function parseMasaKerja($masaKerja)
    {
        // Misalnya '1 thn 1 bln' -> 13 bulan
        $tahun = 0;
        $bulan = 0;

        if (preg_match('/(\d+)\s*thn/', $masaKerja, $matches)) {
            $tahun = (int)$matches[1];
        }

        if (preg_match('/(\d+)\s*bln/', $masaKerja, $matches)) {
            $bulan = (int)$matches[1];
        }

        return $tahun * 12 + $bulan; // total bulan
    }

    // Fungsi untuk menentukan tanggal kenaikan pangkat berikutnya
    private function tentukanKenaikanPangkat($masaKerja, $tanggalSK)
    {
        $tanggalSK = Carbon::parse($tanggalSK);

        // Hitung tahun masa kerja berdasarkan bulan
        $totalTahun = floor($masaKerja / 12);
        $totalBulan = $masaKerja % 12;

        // Tentukan tahun kenaikan pangkat berikutnya
        $tahunKenaikanPangkat = $totalTahun + (4 - ($totalTahun % 4)); // Kenaikan setiap 4 tahun

        // Tentukan tanggal 1 April pada tahun kenaikan pangkat berikutnya
        $tanggalKenaikanPangkat = Carbon::create($tanggalSK->year + $tahunKenaikanPangkat, 4, 1);

        // Jika sudah lewat tanggal 1 April tahun ini, maka kenaikan pangkat berikutnya tahun depan
        if ($tanggalKenaikanPangkat->lt(Carbon::now())) {
            $tanggalKenaikanPangkat->addYears(4);
        }

        return [
            'kenaikan_pangkat' => "Golongan " . ($totalTahun + 1), // Sesuaikan dengan logika golongan Anda
            'tanggal_sk' => $tanggalKenaikanPangkat->toDateString()
        ];
    }
}
