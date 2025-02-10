<?php

namespace App\Models\Lkpd;

use App\Models\Bidang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class IkuRealisasi extends Model
{
    use HasFactory;

    protected $connection = 'apbd';
    protected $table = 'iku_realisasi';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function sasaran()
    {
        return $this->belongsTo(SasaranStrategis::class, 'sasaran_strategis_id');
    }

    public function Bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function IK()
    {
        return $this->belongsTo(IndikatorKinerja::class, 'indikator_kinerja_id');
    }

    public function formula()
    {
        return $this->belongsTo(Formulasi::class, 'formula_id');
    }
}
