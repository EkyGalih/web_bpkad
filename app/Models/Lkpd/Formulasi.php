<?php

namespace App\Models\Lkpd;

use App\Models\Bidang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Formulasi extends Model
{
    use HasFactory;

    protected $connection = 'apbd';
    protected $table = 'formulasi';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string)Uuid::generate(4);
        });
    }

    public static function getFormula()
    {
        return Formulasi::select('id as formula_id', 'formulasi.*')->get();
    }

    public function IndikatorKinerja()
    {
        return $this->belongsTo(IndikatorKinerja::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function Iku()
    {
        return $this->hasOne(IkuRealisasi::class, 'id');
    }
}
