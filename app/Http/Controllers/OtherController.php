<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Other;

class OtherController extends Controller
{
    public function index()
    {        
        $others = Other::withCount('posts')->where('name', '!=', 'uncategorized')->paginate(16);

        return view('others.index', [
            'others' => $others
        ]);
    }

    public function show(Other $other)
    {
        if ($other->name === 'uncategorized') {
            abort(404);
        }

        $posts = $other->posts()->latest()->paginate(10);
        
        // SIDE_RECENT_POSTS Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $recent_posts = Post::latest()
            ->whereDoesntHave('category', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->orWhereDoesntHave('platform', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->orWhereDoesntHave('other', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->take(5)
            ->get();

        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('others.show', [
            'other' => $other,
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
        ]);    
    }
}
