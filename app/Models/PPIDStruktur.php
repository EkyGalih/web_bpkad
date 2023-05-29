<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPIDStruktur extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'ppid_struktur';
    protected $guarded = ['created_at', 'updated_at'];

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
