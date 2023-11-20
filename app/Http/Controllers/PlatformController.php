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
        $platforms = Platform::withCount(['posts' => function ($query) {
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
            ->deleted()
            ->paginate(20);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();

        return view('platforms.show', [
            'platform' => $platform,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
