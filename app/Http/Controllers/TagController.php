<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;
use App\Models\Tag;

class TagController extends Controller
{  
    public function index()
    {
        // view all tags in the blog
    }

    public function show(Tag $tag)
    {        
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $platforms = Platform::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $others = Other::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $tag->posts()->paginate(10),
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'platforms' => $platforms,
            'others' => $others,
        ]);
    }
}
