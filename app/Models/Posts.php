<?php

namespace App\Models;

use App\Enum\CategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Webpatser\Uuid\Uuid;

class Posts extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'posts';
    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->id = (string)Uuid::generate(4);
    //     });
    // }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(PostsCategory::class, 'posts_category_id');
    }

    public function TypeContent()
    {
        return $this->belongsTo(ContentType::class);
    }

    public function Comment()
    {
        return $this->hasMany(PostComment::class);
    }

    public function scopeAgendaKaban($query, $val = 'ya')
    {
        $query->where('agenda_kaban', $val);
    }

    public function scopewhereDeleted($query)
    {
        $query->where('deleted_at', '!=', null);
    }
}
