<?php

namespace App\Http\Controllers;

use App\Models\Tag;

use App\Services\RecentPostsService;

class TagController extends Controller
{
    public function show(Tag $tag, RecentPostsService $recentPostsService)
    {
        $recent_posts = $recentPostsService->getRecentPosts();
        
        if ($tag->name === 'uncategorized') {
            abort(404); }

        $posts = $tag->posts()->excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(20);

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }
}
