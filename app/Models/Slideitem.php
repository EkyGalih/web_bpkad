<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webpatser\Uuid\Uuid;

class Slideitem extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'slide_item';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function slide(): BelongsTo
    {
        return $this->belongsTo(Slide::class, 'slide_id');
    }
}
