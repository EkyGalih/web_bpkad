<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'pegawai';
    protected $guarded = ['createdAt', 'updatedAt'];

    public function PPIDStruktur()
    {
        return $this->hasOne(PPIDStruktur::class);
    }
}
