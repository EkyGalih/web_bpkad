<?php

namespace App\Models\Lkpd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class SasaranStrategis extends Model
{
    use HasFactory;
    protected $connection = 'apbd';
    protected $table = 'sasaran_strategis';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function iku()
    {
        return $this->hasMany(IkuRealisasi::class, 'sasaran_strategis_id');
    }
}
