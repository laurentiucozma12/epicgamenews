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
        $videoGames = VideoGame::withCount('posts')->where('name', '!=', 'uncategorized')->paginate(16);

        return view('videogames.index', [
            'videoGames' => $videoGames
        ]);
    }

    public function show(VideoGame $videoGame)
    {
        if ($videoGame->name === 'uncategorized') {
            abort(404);
        }

        $posts = $videoGame->posts()
            ->where(function ($query) {                
                $query->where(function ($videoGameQuery) {
                    $videoGameQuery->whereDoesntHave('videoGame', function ($videoGameQuery) {
                        $videoGameQuery->where('name', 'uncategorized');
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
            ->withCount('comments')
            ->paginate(10);

        // SIDE_RECENT_POSTS Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $recent_posts = Post::latest()
            ->where(function ($query) {
                $query->where(function ($videoGameQuery) {
                    $videoGameQuery->whereDoesntHave('category', function ($videoGameQuery) {
                        $videoGameQuery->where('name', 'uncategorized');
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
            
        $videoGames = VideoGame::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('videogames.show', [
            'videoGame' => $videoGame,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'videoGames' => $videoGames,
        ]);
    }
}
