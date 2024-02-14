<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\Post;
use App\Models\VideoGame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RecentPostsService;

class VideoGameController extends Controller
{
    public function index()
    {
        $seo = Seo::where('page_name', 'Video Game')->first();
        
        $video_games = VideoGame::where('deleted', 0)
            ->whereHas('posts', function ($query) {
                // A video game is attached to a post. 
                // If the video game has 0 posts (Not 'deleted' posts),
                // the video game should not be visible.
                $query->where('deleted', 0);
            })
            ->orderBy('name', 'ASC')
            ->paginate(20);

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
