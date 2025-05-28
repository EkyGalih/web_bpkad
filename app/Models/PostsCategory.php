<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class PostsCategory extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'posts_category';
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'posts_category_id');
    }
}
