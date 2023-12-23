<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\VideoGame;
use App\Models\Tag;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'slug', 'excerpt', 'body', 'user_id', 'video_game_id', 'author_thumbnail', 'deleted'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function video_game()
    {
        return $this->belongsTo(VideoGame::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}