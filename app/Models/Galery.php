<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'galery';
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->id = (string)Uuid::generate(4);
    //     });
    // }

    public function GaleryFoto()
    {
        return $this->hasMany(GaleryFoto::class);
    }

    public function GaleryVideo()
    {
        return $this->hasMany(GaleryVideo::class);
    }
}
