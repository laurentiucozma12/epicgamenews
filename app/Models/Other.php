<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\Image;

class Other extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'user_id', 'deleted'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    // Scope functions
    public function scopeDeleted($query)
    {
        return $query->where('deleted', 0); 
    }
}
