<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class SubPages extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'sub_pages';
    protected $guarded = ['created_at', 'updated_at'];

    public function Pages()
    {
        return $this->belongsTo(Pages::class);
    }

}
