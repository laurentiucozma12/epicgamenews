<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;

class VideoGame extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'user_id', 'deleted'];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'video_game_category', 'video_game_id', 'category_id');
    }
    
    public function platforms()
    {        
        return $this->belongsToMany(Platform::class, 'video_game_platform', 'video_game_id', 'platform_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
