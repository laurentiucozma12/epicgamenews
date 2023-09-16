<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use App\Models\Post;

class Other extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($other) {
            $other->slug = Str::slug($other->name);
        });
    }
}
