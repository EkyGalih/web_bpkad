<?php

namespace App\Models\Lkpd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class LaporanRealisasiAnggaran extends Model
{
    use HasFactory;
    protected $connection = 'apbd';
    protected $table = 'realisasi_anggaran';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function apbd()
    {
        return $this->belongsTo(Apbd::class, 'kode_rekening');
    }
}
