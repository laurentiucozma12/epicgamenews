<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'user_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function seo()
    {
        return $this->hasOne(Seo::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name, '-');
        });

        static::updating(function ($tag) {
            $tag->slug = Str::slug($tag->name, '-');
        });
    }
}
