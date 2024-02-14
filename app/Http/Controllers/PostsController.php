<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use App\Services\RecentPostsService;


class PostsController extends Controller
{ 
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function show(Post $post, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('page_type', 'Post')->first();
        
        $recent_posts = $recentPostsService->getRecentPosts();

        $tags = $post->tags;

        return view('components/post', [
            'seo' => $seo,
            'post' => $post,
            'recent_posts' => $recent_posts,
            'tags' => $tags,
        ]);
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}
