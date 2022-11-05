<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class SubPages extends Model
{
    protected $table = 'sub_pages';

    protected $guarded = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function Pages()
    {
        return $this->belongsTo(Pages::class);
    }

    public static function getSubMenu($param)
    {
        return SubPages::where('sub_pages_id', '=', $param)->select('sub_pages.title', 'sub_pages.id as sub_menu_id')->get();
    }

}
