<?php

namespace App\Services;

use App\Models\Category;

class CategoriesService
{
    public function getCategories()
    {
        return Category::where('deleted', 0)
            ->whereHas('videoGames', function ($query) {
                // A platform is attached to a video game. A video game is attached to a post.
                // Even if a video game has a platform, if the same video game has 0 posts (Not 'deleted' posts),
                // the platform should not be visible.
                $query->where('deleted', 0)
                    ->whereHas('posts', function ($query) {
                        // A video game is attached to a post. 
                        // If the video game has 0 posts (Not 'deleted' posts),
                        // the video game should not be visible.
                        $query->where('deleted', 0);
                    });
            })
            ->withCount(['videoGames' => function ($query) {
                // Count the number of posts for each video game
                $query->where('deleted', 0)
                    ->whereHas('posts', function ($query) {
                        // A video game is attached to a post. 
                        // If the video game has 0 posts (Not 'deleted' posts),
                        // the video game should not be visible.
                        $query->where('deleted', 0);
                    });
            }])
            ->orderBy('video_games_count', 'DESC');
        }
}