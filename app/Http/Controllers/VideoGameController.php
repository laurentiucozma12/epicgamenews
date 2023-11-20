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
        $video_games = VideoGame::withCount(['posts' => function ($query) {
            // Count only the posts that are NOT 'deleted' or 'uncategorized'
            $query->where('deleted', '=', 0)
                ->where('name', '!=', 'uncategorized');
        }])
        ->whereHas('posts', function ($query) {
            // Send only the posts where count is bigger than 0
            $query->where('deleted', '=', 0)
                ->where('name', '!=', 'uncategorized');
        })
        ->where('name', '!=', 'uncategorized')
        ->deleted()
        ->paginate(16);

        return view('video_games.index', [
            'video_games' => $video_games
        ]);
    }

    public function show(VideoGame $video_game)
    {
        if ($video_game->name === 'uncategorized') {
            abort(404);
        }
        
        $posts = $video_game->posts()->excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(20);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(5);
            
        $recent_postsArray = $recent_posts->items();

        return view('video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
