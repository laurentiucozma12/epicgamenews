<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\VideoGame;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Other;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'slug', 'excerpt', 'body', 'user_id', 'video_game_id', 'other_id', 'author_thumbnail', 'approved'];

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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }
    
    public function platforms()
    {        
        return $this->belongsToMany(Category::class, 'post_platform', 'post_id', 'platform_id');
    }

    public function other()
    {
        return $this->belongsTo(Other::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Scope function
    public function scopeApproved($query)
    {
        return $query->where('approved', 1); 
    }

    public function scopeExcludeUncategorized($query)
    {
        return $query->where(function ($query) {
            $query->where(function ($video_gameQuery) {
                $video_gameQuery->whereDoesntHave('video_game', function ($video_gameQuery) {
                    $video_gameQuery->where('name', 'uncategorized');
                });
            })
            ->orWhere(function ($categoryQuery) {
                $categoryQuery->whereDoesntHave('categories', function ($categoryQuery) {
                    $categoryQuery->where('name', 'uncategorized');
                });
            })
            ->orWhere(function ($platformQuery) {
                $platformQuery->whereDoesntHave('platforms', function ($platformQuery) {
                    $platformQuery->where('name', 'uncategorized');
                });
            })
            ->orWhere(function ($otherQuery) {
                $otherQuery->whereDoesntHave('other', function ($otherQuery) {
                    $otherQuery->where('name', 'uncategorized');
                });
            });
        });
    }
}