<?php

namespace App\Models\Lkpd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Schedule extends Model
{
    protected $connection = 'apbd';
    protected $table = 'schedule';
    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
