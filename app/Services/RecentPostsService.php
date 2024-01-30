<?php

namespace App\Services;

use App\Models\Post;

class RecentPostsService
{
    public function getRecentPosts($limit = 5)
    {
        return Post::excludeUncategorized()
            ->where('deleted', 0)
            ->latest()
            ->limit($limit)
            ->get();
    }
}