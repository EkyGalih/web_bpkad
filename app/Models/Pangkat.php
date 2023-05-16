<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'pangkat';
    protected $guarded = ['createdAt', 'updatedAt'];
}
