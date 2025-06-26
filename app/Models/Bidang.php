<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webpatser\Uuid\Uuid;

class Bidang extends Model
{
    use HasFactory;

    protected $connection = 'simpeg';
    public $incrementing = false;
    protected $table = 'bidang';
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

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'bidang_id');
    }

    public static function countPegawai($id)
    {
        return Pegawai::where('bidang_id', $id)->count();
    }

    public function olympic(): HasMany
    {
        return $this->hasMany(Olympic::class, 'bidang_id', 'id');
    }
}
