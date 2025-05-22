<?php

namespace App\Models\Lkpd;

use App\Models\Bidang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class KegiatanIku extends Model
{
    use HasFactory;
    protected $connection = 'apbd';
    public $incrementing = false;
    protected $table = 'kegiatan_iku';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function SubKegiatanIku()
    {
        return $this->hasMany(SubKegiatanIku::class);
    }

    public function Bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}
