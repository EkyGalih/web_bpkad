<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'banner';
    protected $guarded = ['created_at', 'updated_at'];
}
