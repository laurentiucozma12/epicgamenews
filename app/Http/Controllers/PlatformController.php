<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use App\Services\RecentPostsService;
use App\Services\PlatformsService;

class PlatformController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function index(PlatformsService $platformsService)
    {
        $seo = Seo::where('page_name', 'Platform')
           ->where('page_type', 'main')
           ->first();
        
        $platforms = $platformsService->getPlatforms()->paginate(20);

        return view('platforms.index', [
            'seo' => $seo,
            'platforms' => $platforms
        ]);
    }

    public function show(Platform $platform, RecentPostsService $recentPostsService)
    {
        // NOT OK
        $seo = Seo::where('page_name', 'Related Platform')
        ->where('page_type', 'platform')
        ->first();

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
