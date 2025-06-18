<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class GaleryVideo extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'galery_video';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function Galery()
    {
        return $this->belongsTo(Galery::class);
    }
}
