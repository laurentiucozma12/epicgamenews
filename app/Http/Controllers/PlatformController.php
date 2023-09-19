<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Platform;

class PlatformController extends Controller
{    
    public function index()
    {
        $platforms = Platform::withCount('posts')->where('name', '!=', 'uncategorized')->paginate(16);

        return view('platforms.index', [
            'platforms' => $platforms
        ]);
    }

    public function show(Platform $platform)
    {
        if ($platform->name === 'uncategorized') {
            abort(404);
        }
        
        $posts = $platform->posts()
            ->where(function ($query) {                
                $query->where(function ($video_gameQuery) {
                    $video_gameQuery->whereDoesntHave('video_game', function ($video_gameQuery) {
                        $video_gameQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($categoryQuery) {
                    $categoryQuery->whereDoesntHave('categories', function ($categoryQuery) {
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
                    $video_gameQuery->whereDoesntHave('video_game', function ($video_gameQuery) {
                        $video_gameQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($categoryQuery) {
                    $categoryQuery->whereDoesntHave('categories', function ($categoryQuery) {
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

        return view('platforms.show', [
            'platform' => $platform,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }
}
