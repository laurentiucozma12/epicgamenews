<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use App\Services\RecentPostsService;

class TagController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function show(Tag $tag, RecentPostsService $recentPostsService)
    {        
        $seo = Seo::where('page_name',  $tag->name)
           ->where('page_type', 'tag')
           ->first();

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
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}
