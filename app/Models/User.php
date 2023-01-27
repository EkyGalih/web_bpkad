<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    public $incrementing = false;
    use Notifiable;

    protected $guarded = ['create_at', 'update_at'];
    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function rule()
    {
        return $this->hasMany(Rule::class);
    }
}
