<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Slideitem extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'slide_item';
    protected $guarded = ['created_at', 'updated_at'];

    public function Slide()
    {
        return $this->belongsTo(Slide::class);
    }
}
