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
        if (
            ($post->category && $post->category->name === 'uncategorized') &&
            ($post->platform && $post->platform->name === 'uncategorized') &&
            ($post->other && $post->other->name === 'uncategorized')
        ) {
            // The post is uncategorized in all three categories, so deny access.
            // You can return a response with an error message or a 404 page.
            abort(404);
        }

        // SIDE_RECENT_POSTS Hide all posts that have all 3 (category/platform/other) set on uncategorized
        $recent_posts = Post::latest()
            ->where(function ($query) {
                $query->where(function ($categoryQuery) {
                    $categoryQuery->whereDoesntHave('category', function ($categoryQuery) {
                        $categoryQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($platformQuery) {
                    $platformQuery->whereDoesntHave('platforms', function ($platformQuery) {
                        $platformQuery->where('name', 'uncategorized');
                    });
                })
                ->orWhere(function ($otherQuery) {
                    $otherQuery->whereDoesntHave('other', function ($otherQuery) {
                        $otherQuery->where('name', 'uncategorized');
                    });
                });
            })
            ->approved()
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
