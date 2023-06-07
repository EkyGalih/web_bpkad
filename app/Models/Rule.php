<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'rule';
    protected $guarded = ['created_at', 'updated_at'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
