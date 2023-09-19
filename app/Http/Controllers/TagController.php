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
        if ($tag->name === 'uncategorized') {
            abort(404); }

        $posts = $tag->posts()->excludeUncategorized()
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);
    }
}
