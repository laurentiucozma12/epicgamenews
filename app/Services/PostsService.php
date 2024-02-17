<?php

namespace App\Services;

use App\Models\Post;

class PostsService
{
    public function getPosts()
    {
        return Post::latest()->where('deleted', 0);
    }
}