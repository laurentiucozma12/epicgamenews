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
        // SIDE_RECENT_POSTS Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $recent_posts = Post::latest()
            ->whereDoesntHave('category', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->whereDoesntHave('platforms', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->whereDoesntHave('other', function ($query) {
                $query->where('name', 'uncategorized');
            })
            ->take(5)
            ->get();
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
