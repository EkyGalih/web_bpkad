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

    public function galeryFoto()
    {
        return $this->hasMany(GaleryFoto::class, 'galery_id', 'id');
    }

    public function galeryVideo()
    {
        return $this->hasMany(GaleryVideo::class, 'galery_id', 'id');
    }

    public function galeryType()
    {
        return $this->belongsTo(GaleryType::class, 'galery_type_id', 'id');
    }
}
