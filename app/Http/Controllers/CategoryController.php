<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{    
    public function index()
    {
        $categories = Category::withCount(['posts' => function ($query) {
            // Count only the posts that are NOT 'deleted' or 'uncategorized'
            $query->where('deleted', '=', 0)
                ->where('name', '!=', 'uncategorized');
        }])
        ->whereHas('posts', function ($query) {
            // Send only the posts where count is bigger than 0
            $query->where('deleted', '=', 0)
                ->where('name', '!=', 'uncategorized');
        })
        ->where('name', '!=', 'uncategorized')
        ->deleted()
        ->paginate(16);

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category)
    {
        if ($category->name === 'uncategorized') {
            abort(404); }    

        $posts = $category->posts()->excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(10);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();
            
        return view('categories.show', [
            'category' => $category,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
