<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Pegawai extends Model
{
    use HasFactory;

    protected $connection = 'simpeg';
    public $incrementing = false;
    protected $table = 'pegawai';
    protected $guarded = ['createdAt', 'updatedAt'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
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
}
