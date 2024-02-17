<?php

namespace App\Services;

use App\Models\Platform;

class PlatformsService
{
    public function getPlatforms()
    {
        return Platform::where('deleted', 0)
            ->whereHas('videoGames', function ($query) {
                // A platform is attached to a video game. A video game is attached to a post.
                // Even if a video game has a platform, if the same video game has 0 posts (Not 'deleted' posts),
                // the platform should not be visible.
                $query->where('deleted', 0)
                    ->whereHas('posts');
            })
            ->orderBy('name', 'ASC');
    }
}