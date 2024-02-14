<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\RecentPostsService;

class TagController extends Controller
{
    public function show(Tag $tag, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('seo_name', $tag->name)->first();
        
        $recent_posts = $recentPostsService->getRecentPosts();
        
        if ($tag->name === 'uncategorized') {
            abort(404); }

        $posts = $tag->posts()
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        return view('tags.show', [
            'seo' => $seo,
            'tag' => $tag,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where(function($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('excerpt', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        })
        ->orWhereHas('video_game', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('video_game.categories', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('video_game.platforms', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->latest()
        ->where('deleted', 0)
        ->paginate(20);

        return view('home', compact('posts', 'search'));
    }
}
