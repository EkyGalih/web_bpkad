<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class GaleryFoto extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'galery_foto';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id', 'id');
    }
}
