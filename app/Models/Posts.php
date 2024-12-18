<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Webpatser\Uuid\Uuid;

class Posts extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'posts';
    protected $guarded = ['updated_at'];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->id = (string)Uuid::generate(4);
    //     });
    // }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(PostsCategory::class);
    }

    public function TypeContent()
    {
        return $this->belongsTo(ContentType::class);
    }

    public function Comment()
    {
        return $this->hasMany(PostComment::class);
    }
}
