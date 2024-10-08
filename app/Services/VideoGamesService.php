<?php

namespace App\Services;

use App\Models\VideoGame;

class VideoGamesService
{
    public function getVideoGames()
    {
        return VideoGame::where('deleted', 0)
            ->whereHas('posts', function ($query) {
                // A video game is attached to a post. 
                // If the video game has 0 posts (Not 'deleted' posts),
                // the video game should not be visible.
                $query->where('deleted', 0);
            })
            ->withCount('posts') // Count the number of posts for each video game
            ->orderBy('posts_count', 'DESC'); // Order by the number of posts in descending order
    }
}