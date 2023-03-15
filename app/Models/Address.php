<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Address extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'office_address';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }
}
