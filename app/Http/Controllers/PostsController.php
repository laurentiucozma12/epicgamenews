<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Platform;
use App\Models\More;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->loadNavbarData();
    }
    
    public function show(Post $post) {

        $recent_posts = Post::latest()->take(5)->get();

        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(12)->get();
        $platforms = Platform::withCount('posts')->orderBy('posts_count', 'desc')->take(12)->get();
        $mores = More::withCount('posts')->orderBy('posts_count', 'desc')->take(12)->get();

        $tags = Tag::latest()->take(50)->get();

        return view('post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'platforms' => $platforms,
            'mores' => $mores,
            'tags' => $tags,
        ]);
    }

    public function addComment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:10|max:300'
        ]);

        $attributes['user_id'] = auth()->id();
        $comment = $post->comments()->create($attributes);

        return redirect('/posts/' . $post->slug . '#comment_' . $comment->id)->with('success', 'Comment has been added');
    }
}
