<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Apps extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'daftar_app';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Rule()
    {
        return $this->hasOne(Rule::class);
    }
}
