<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::where('deleted', 0)
            ->whereHas('videoGames', function ($query) {
                // A platform is attached to a video game. A video game is attached to a post.
                // Even if a video game has a platform, if the same video game has 0 posts (Not 'deleted' posts),
                // the platform should not be visible.
                $query->where('deleted', 0)
                    ->whereHas('posts');
            })
            ->paginate(20);

        return view('platforms.index', [
            'platforms' => $platforms
        ]);
    }

    public function show(Platform $platform)
    {
        $videoGameIds = $platform->videoGames()->pluck('video_game_id');

        $posts = Post::whereIn('video_game_id', $videoGameIds)
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        $recent_posts = Post::latest()
            ->where('deleted', 0)
            ->paginate(5);

        $recent_posts = $recent_posts->items();

        return view('platforms.show', [
            'platform' => $platform,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }
}
