<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\More;

class MoreController extends Controller
{
    public function index()
    {
        return view('mores.index', [
            'mores' => More::withCount('posts')->paginate(12)
        ]);
    }

    public function show(More $more)
    {
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        return view('mores.show', [
            'more' => $more,
            'posts' => $more->posts()->paginate(5),
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);    
    }
}
