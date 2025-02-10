<?php

namespace App\Models\Lkpd;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class KodeRekening extends Model
{
    protected $connection = 'apbd';
    public $incrementing = false;
    protected $table = 'kode_rekening';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }
}
