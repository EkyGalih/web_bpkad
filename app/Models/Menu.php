<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Menu extends Model
{
    protected $table = 'menu';

    protected $guarded = ['create_at', 'update_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public static function getAll()
    {
        return Menu::select('menu.id as menu_id', 'menu.*')->orderBy('order_pos', 'ASC')->get();
    }
}
