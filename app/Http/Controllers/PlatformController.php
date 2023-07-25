<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Platform;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Categories;
use App\Models\Category;

class PlatformController extends Controller
{
    public function index()
    {
        return view('platforms.index', [
            'platforms' => Platform::withCount('posts')->paginate(5)
        ]);
    }

    public function show(Platform $platform)
    {
        $recent_posts = Post::latest()->take(5)->get();
        $platforms = Platform::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        return view('platforms.show', [
            'platform' => $platform,
            'posts' => $platform->posts()->paginate(5),
            'recent_posts' => $recent_posts,
            'platforms' => $platforms,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
