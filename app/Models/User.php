<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    public $incrementing = false;
    use Notifiable;

    protected $guarded = ['create_at', 'update_at'];
    protected $hidden = ['password', 'remember_token'];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->id = (string)Uuid::generate(4);
    //     });
    // }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function rule()
    {
        return $this->hasOne(Rule::class);
    }

    public function Apps()
    {
        return $this->hasMany(Apps::class);
    }

    public function Social()
    {
        return $this->hasOne(Social::class);
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
