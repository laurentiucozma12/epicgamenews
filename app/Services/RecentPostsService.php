<?php

namespace App\Services;

use App\Models\Post;

class RecentPostsService
{
    public function getRecentPosts($limit = 5)
    {
        return Post::latest()
            ->where('deleted', 0)            
            ->limit($limit)
            ->get();
    }
}