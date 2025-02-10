<?php

namespace App\Models\Lkpd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Apbd extends Model
{
    use HasFactory;
    protected $connection = 'apbd';
    public $incrementing = false;
    protected $table = 'apbd';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function Realisasi()
    {
        return $this->hasOne(LaporanRealisasiAnggaran::class, 'kode_rekening');
    }
}
