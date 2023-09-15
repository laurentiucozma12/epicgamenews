<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class CategoryController extends Controller
{    
    public function index()
    {
        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->paginate(16);

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category)
    {
        if ($category->name === 'uncategorized') {
            abort(404);
        }

        $posts = $category->posts()->latest()->paginate(10);

        // SIDE_RECENT_POSTS Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $recent_posts = Post::latest()
            ->whereDoesntHave('category', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->orWhereDoesntHave('platforms', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->orWhereDoesntHave('other', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->take(5)
            ->get();
            
        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('categories.show', [
            'category' => $category,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
        ]);
    }
}
