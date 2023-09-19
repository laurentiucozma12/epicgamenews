<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;

class HomeController extends Controller
{
    public function index()
    {
        // POSTS Hide posts that have all 3 (category/platform/other) set on uncategorized
        $posts = Post::latest()
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
            ->withCount('comments')
            ->paginate(10);

        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();
        $platforms = Platform::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();
        $others = Other::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'platforms' => $platforms,
            'others' => $others,
        ]);
    }
}
