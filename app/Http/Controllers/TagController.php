<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;
use App\Models\Tag;

class TagController extends Controller
{  
    public function index()
    {
        // view all tags in the blog
    }

    public function show(Tag $tag)
    {        
        // Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $posts = $tag->posts()
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
            ->approved()
            ->take(5)
            ->get();
            
        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
        ]);
    }
}
