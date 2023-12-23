<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{ 
    public function show(Post $post)
    {
        $recent_posts = Post::latest()
            ->where('deleted', 0)
            ->paginate(5);

        $recent_posts = $recent_posts->items();

        $tags = $post->tags;

        return view('components/post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            'tags' => $tags,
        ]);
    }
}
