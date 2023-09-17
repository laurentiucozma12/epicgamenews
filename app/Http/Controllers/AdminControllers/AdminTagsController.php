<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tag;

class AdminTagsController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.tags.index', [
            'tags' => Tag::with('posts')->paginate(100),
        ]);
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(100);
        return view('admin_dashboard.tags.show', [
            'tag' => $tag,
            'posts' => $posts,
        ]);
    }

    public function destroy(Tag $tag)
    {
        $posts = $tag->posts;
        $tag->posts()->detach();
        $tag->delete();

        // If a post has only 1 tag, and that tag gets deleted the post changes to "Not approved"
        foreach ($posts as $post) {
            // Check if the post has any other tags left
            if ($post->tags->isEmpty()) {
                // Update the post's status to "not approved"
                $post->update(['approved' => false]);
            }
        }

        return redirect()->route('admin.tags.index')->with('success', 'Tag has been Deleted');
    }
}
