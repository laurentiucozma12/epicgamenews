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
            abort(404); }

        $posts = $platform->posts()->excludeUncategorized()
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();

        return view('platforms.show', [
            'platform' => $platform,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
