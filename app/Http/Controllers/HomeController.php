<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;

class HomeController extends Controller
{
    public function index()
    {
        // Get only approved posts that have at least one of the $query != 'uncategorized
        $posts = Post::latest()
        // ->where(function ($query) {
        //     $query->whereHas('category', function ($categoryQuery) {
        //         $categoryQuery->where('name', '!=', 'uncategorized');
        //     })
        //     ->orWhereHas('platform', function ($platformQuery) {
        //         $platformQuery->where('name', '!=', 'uncategorized');
        //     })
        //     ->orWhereHas('other', function ($otherQuery) {
        //         $otherQuery->where('name', '!=', 'uncategorized');
        //     });
        // })
        ->approved()
        ->withCount('comments')
        ->paginate(10);

        $recent_posts = Post::latest()
            ->whereHas('category', function ($query) {
                $query->where('name', '!=', 'uncategorized');
            })->take(5)->get();

        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();
        $platforms = Platform::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();
        $others = Other::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(10)->get();

        $tags = Tag::latest()->take(50)->get();

        return view('home', [
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'platforms' => $platforms,
            'others' => $others,
            'tags' => $tags,
        ]);
    }
}
