<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    protected $connection = 'simpeg';
    public $incrementing = false;
    protected $table = 'pangkat';
    protected $guarded = ['createdAt', 'updatedAt'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'pangkat_id');
    }
}
