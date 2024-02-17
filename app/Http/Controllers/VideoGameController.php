<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\Post;
use App\Models\VideoGame;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use App\Services\VideoGamesService;
use App\Http\Controllers\Controller;
use App\Services\RecentPostsService;

class VideoGameController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function index(VideoGamesService $videoGamesService)
    {
        $seo = Seo::where('page_name', 'Video Game')->first();
        
        $video_games = $videoGamesService->getVideoGames()->paginate(20);

        return view('video_games.index', [
            'seo' => $seo,
            'video_games' => $video_games
        ]);
    }

    public function show(VideoGame $video_game, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('seo_name', $video_game->name)->first();

        $recent_posts = $recentPostsService->getRecentPosts();

        $posts = $video_game->posts()
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        return view('video_games.show', [
            'seo' => $seo,
            'video_game' => $video_game,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function searchVideoGame(Request $request)
    {
        $search = $request->search;

        $video_games = VideoGame::where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('categories', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('platforms', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->latest()
        ->where('deleted', 0)
        ->paginate(20);

        return view('video_games.index', compact('video_games', 'search'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}
