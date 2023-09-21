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
        $video_games = VideoGame::withCount('posts')->where('name', '!=', 'uncategorized')->paginate(16);

        return view('video_games.index', [
            'video_games' => $video_games
        ]);
    }

    public function show(VideoGame $video_game)
    {
        if ($video_game->name === 'uncategorized') {
            abort(404);
        }
        
        $posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->paginate(5);
            
        $recent_postsArray = $recent_posts->items();

        return view('video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
