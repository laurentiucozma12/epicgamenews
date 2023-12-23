<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VideoGame;
use App\Models\Post;

class VideoGameController extends Controller
{
    public function index()
    {
        $video_games = VideoGame::where('deleted', 0)
            ->whereHas('posts', function ($query) {
                // A video game is attached to a post. 
                // If the video game has 0 posts (Not 'deleted' posts),
                // the video game should not be visible.
                $query->where('deleted', 0);
            })
            ->has('posts')
            ->paginate(20);

        return view('video_games.index', [
            'video_games' => $video_games
        ]);
    }

    public function show(VideoGame $video_game)
    {        
        $posts = $video_game->posts()
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        $recent_posts = Post::latest()
            ->where('deleted', 0)
            ->paginate(5);
            
        $recent_posts = $recent_posts->items();

        return view('video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }
}
