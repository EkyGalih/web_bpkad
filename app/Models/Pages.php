<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Pages extends Model
{
    protected $table = 'pages';

    protected $guarded = ['create_at', 'update_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function subPages()
    {
        return $this->hasMany(SubPages::class);
    }

    public static function getById($param)
    {
        return Pages::where('menu_id', '=', $param)->select('pages.title', 'pages.id as sub_menu_id')->get();
    }
}
