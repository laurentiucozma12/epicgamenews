<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use App\Models\Post;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_platform');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($platform) {
            $platform->slug = Str::slug($platform->name);
        });
    }
}
