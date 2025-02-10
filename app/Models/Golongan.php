<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    protected $connection = 'simpeg';
    public $incrementing = false;
    protected $table = 'golongan';
    protected $guarded = ['createdAt', 'updatedAt'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'golongan_id');
    }
}
