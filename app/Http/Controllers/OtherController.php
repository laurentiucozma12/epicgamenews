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
            abort(404); }

        $posts = $other->posts()->excludeUncategorized()
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();

        return view('others.show', [
            'other' => $other,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);    
    }
}
