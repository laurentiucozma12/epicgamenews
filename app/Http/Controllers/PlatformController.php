<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use App\Services\RecentPostsService;

class PlatformController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function index()
    {
        $seo = Seo::where('page_name', '=', 'Platform')->first();
        
        $platforms = Platform::where('deleted', 0)
            ->whereHas('videoGames', function ($query) {
                // A platform is attached to a video game. A video game is attached to a post.
                // Even if a video game has a platform, if the same video game has 0 posts (Not 'deleted' posts),
                // the platform should not be visible.
                $query->where('deleted', 0)
                    ->whereHas('posts');
            })
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return view('platforms.index', [
            'seo' => $seo,
            'platforms' => $platforms
        ]);
    }

    public function show(Platform $platform, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('seo_name', $platform->name)->first();
        $recent_posts = $recentPostsService->getRecentPosts();
        $videoGameIds = $platform->videoGames()->pluck('video_game_id');

        $posts = Post::whereIn('video_game_id', $videoGameIds)
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        return view('platforms.show', [
            'seo' => $seo,
            'platform' => $platform,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function searchPlatform(Request $request)
    {
        $search = $request->search;

        $platforms = Platform::where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->latest()
        ->where('deleted', 0)
        ->paginate(20);

        return view('platforms.index', compact('platforms', 'search'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}
