<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webpatser\Uuid\Uuid;

class Slide extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'slide';
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function slide_item(): HasMany
    {
        return $this->hasMany(Slideitem::class, 'slide_id');
    }
}
