<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class LokasiAset extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'lokasi_aset';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }

    public function asetTIK()
    {
        return $this->belongsTo(AsetTIK::class, 'aset_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    // ambil aset tiap pegawai
    public static function getAsetByPegawaiId($pegawaiId)
    {
        return self::where('pegawai_id', $pegawaiId)->with('asetTIK')->get();
    }

    public static function getPegawaiByAsetId($aset_id)
    {
        return self::where('aset_id', $aset_id)->with('pegawai')->groupBy('pegawai_id')->get();
    }
}
