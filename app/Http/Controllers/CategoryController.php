<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
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
            abort(404); }    

        $posts = $category->posts()->excludeUncategorized()
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();
            
        return view('categories.show', [
            'category' => $category,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
