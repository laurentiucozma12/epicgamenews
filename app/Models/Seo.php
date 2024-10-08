<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = ['page_type', 'page_name', 'seo_name', 'seo_title', 'seo_description', 'seo_keywords', 'user_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function videoGame()
    {
        return $this->belongsTo(VideoGame::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
