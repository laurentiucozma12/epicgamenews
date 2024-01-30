<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Services\RecentPostsService;


class PostsController extends Controller
{ 
    public function show(Post $post, RecentPostsService $recentPostsService)
    {
        $recent_posts = $recentPostsService->getRecentPosts();

        $tags = $post->tags;

        return view('components/post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            'tags' => $tags,
        ]);
    }
}
