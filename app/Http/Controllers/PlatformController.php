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
        
        $posts = $platform->posts()->latest()->paginate(10);

        $recent_posts = Post::latest()
            ->whereHas('platform', function ($query) {
                $query->where('name', '!=', 'uncategorized');
            })->take(5)->get();
            
        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        return view('platforms.show', [
            'platform' => $platform,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
