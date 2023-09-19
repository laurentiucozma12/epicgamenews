<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{ 
    public function show(Post $post)
    {       
        if (
            ($post->video_game && $post->video_game->name === 'uncategorized') &&
            ($post->category && $post->category->name === 'uncategorized') &&
            ($post->platform && $post->platform->name === 'uncategorized') &&
            ($post->other && $post->other->name === 'uncategorized')
        ) {
            // The post is uncategorized in all fields, the access is denied.
            // You can return a response with an error message or a 404 page.
            abort(404);
        }
        
        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();

        $tags = $post->tags;

        return view('post', [
            'post' => $post,
            'recent_posts' => $recent_postsArray,
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
