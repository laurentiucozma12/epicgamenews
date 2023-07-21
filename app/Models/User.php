<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Model\Role;
use App\Model\Post;
use App\Model\Comment;
use App\Models\Image;
use App\Models\Category;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role() 
    {     
        return $this->belongsTo(Role::class);
    }

    public function post() 
    {     
        return $this->hasMany(Post::class);
    }

    public function comment() 
    {     
        return $this->hasMany(Comment::class);
    }
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
