<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'golongan';
    protected $guarded = ['createdAt', 'updatedAt'];
}
