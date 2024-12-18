<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $connection = 'simpeg';
    public $incrementing = false;
    protected $table = 'bidang';
    protected $guarded = ['createdAt', 'updatedAt'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'bidang_id');
    }
}
