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
        return view('others.index', [
            'others' => Other::withCount('posts')->paginate(12)
        ]);
    }

    public function show(Other $other)
    {
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        return view('others.show', [
            'other' => $other,
            'posts' => $other->posts()->paginate(5),
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);    
    }
}
