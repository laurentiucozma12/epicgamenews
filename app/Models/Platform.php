<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Image;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'user_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_platform', 'post_id', 'platform_id');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($platform) {
            $platform->slug = Str::slug($platform->name);
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
