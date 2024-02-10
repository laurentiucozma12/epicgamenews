<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\RecentPostsService;

class CategoryController extends Controller
{
    public function index()
    {
        $seo = Seo::where('page_name', '=', 'Category')->first();
        
        $categories = Category::where('deleted', 0)
            ->whereHas('videoGames', function ($query) {
                // A platform is attached to a video game. A video game is attached to a post.
                // Even if a video game has a platform, if the same video game has 0 posts (Not 'deleted' posts),
                // the platform should not be visible.
                $query->where('deleted', 0)
                    ->whereHas('posts');
            })
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return view('categories.index', [
            'seo' => $seo,
            'categories' => $categories
        ]);
    }

    public function show(Category $category, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('seo_name', $category->name)->first();
        $recent_posts = $recentPostsService->getRecentPosts();
        
        $videoGameIds = $category->videoGames()->pluck('video_game_id');

        $posts = Post::whereIn('video_game_id', $videoGameIds)
            ->latest()
            ->where('deleted', 0)
            ->paginate(20);

        return view('categories.show', [
            'seo' => $seo,
            'category' => $category,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
        ]);
    }
}
