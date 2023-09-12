<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;

class PostsController extends Controller
{ 
    public function show(Post $post)
    {
        $recent_posts = Post::latest()
            ->where(function ($query) {
                $query->whereHas('category', function ($categoryQuery) {
                    $categoryQuery->where('name', '!=', 'uncategorized');
                })
                ->orWhereHas('platform', function ($platformQuery) {
                    $platformQuery->where('name', '!=', 'uncategorized');
                })
                ->orWhereHas('other', function ($otherQuery) {
                    $otherQuery->where('name', '!=', 'uncategorized');
                });
            })
            ->take(5)
            ->get();

        $categories = Category::withCount('posts')->where('name', '!=', 'uncategorized')->orderBy('posts_count', 'desc')->take(12)->get();

        $tags = $post->tags;

        return view('post', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
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

        return redirect($post->slug . '#comment_' . $comment->id)->with('success', 'Comment has been added');
    }
}
