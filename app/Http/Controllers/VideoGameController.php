<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\VideoGame;
use App\Http\Controllers\Controller;
use App\Services\RecentPostsService;

class VideoGameController extends Controller
{
    public function index()
    {
        $seo = Seo::where('page_name', '=', 'Video Game')->first();
        
        $video_games = VideoGame::where('deleted', 0)
            ->whereHas('posts', function ($query) {
                // A video game is attached to a post. 
                // If the video game has 0 posts (Not 'deleted' posts),
                // the video game should not be visible.
                $query->where('deleted', 0);
            })
            ->paginate(20);

        return view('video_games.index', [
            'seo' => $seo,
            'video_games' => $video_games
        ]);
    }

    public function show(VideoGame $video_game, RecentPostsService $recentPostsService)
    {
        $recent_posts = $recentPostsService->getRecentPosts();
        
        $posts = $video_game->posts()
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        return view('video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }
}
