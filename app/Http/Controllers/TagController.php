<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Tag;
use App\Services\RecentPostsService;

class TagController extends Controller
{
    public function show(Tag $tag, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('title', $tag->name)->first();
        
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
}
