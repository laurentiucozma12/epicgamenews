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

        $posts = $video_game->posts()
            ->where(function ($query) {                
                $query->where(function ($video_gameQuery) {
                    $video_gameQuery->whereDoesntHave('video_game', function ($video_gameQuery) {
                        $video_gameQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($categoryQuery) {
                    $categoryQuery->whereDoesntHave('category', function ($categoryQuery) {
                        $categoryQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($platformQuery) {
                    $platformQuery->whereDoesntHave('platforms', function ($platformQuery) {
                        $platformQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($otherQuery) {
                    $otherQuery->whereDoesntHave('other', function ($otherQuery) {
                        $otherQuery->where('name', 'uncategorized');
                    });
                });
            })
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        // SIDE_RECENT_POSTS Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $recent_posts = Post::latest()
            ->where(function ($query) {
                $query->where(function ($video_gameQuery) {
                    $video_gameQuery->whereDoesntHave('category', function ($video_gameQuery) {
                        $video_gameQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($categoryQuery) {
                    $categoryQuery->whereDoesntHave('category', function ($categoryQuery) {
                        $categoryQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($platformQuery) {
                    $platformQuery->whereDoesntHave('platforms', function ($platformQuery) {
                        $platformQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($otherQuery) {
                    $otherQuery->whereDoesntHave('other', function ($otherQuery) {
                        $otherQuery->where('name', 'uncategorized');
                    });
                });
            })
            ->approved()
            ->take(5)
            ->get();
            
        $video_games = VideoGame::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'video_games' => $video_games,
        ]);
    }
}
