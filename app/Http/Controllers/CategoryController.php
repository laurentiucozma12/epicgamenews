<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use App\Services\RecentPostsService;
use App\Services\CategoriesService;

class CategoryController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function index(CategoriesService $categoriesService)
    {        
        $seo = Seo::where('page_name', 'Category')
           ->where('page_type', 'main')
           ->first();

        $categories = $categoriesService->getCategories()->paginate(20);

        return view('categories.index', [
            'seo' => $seo,
            'categories' => $categories
        ]);
    }

    public function show(Category $category, RecentPostsService $recentPostsService)
    {
        $seo = Seo::where('page_name', 'Related Category')
            ->where('page_type', 'category')
            ->first();

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

    public function searchCategory(Request $request)
    {
        $search = $request->search;

        $categories = Category::where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->latest()
        ->where('deleted', 0)
        ->paginate(20);

        return view('categories.index', compact('categories', 'search'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}
