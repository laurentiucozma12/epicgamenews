<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use App\Models\VideoGame;
use App\Models\Image;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'user_id', 'deleted'];

    public function videoGames()
    {
        return $this->belongsToMany(VideoGame::class, 'video_game_category');
    }

    public function seo()
    {
        return $this->hasOne(Seo::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
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
