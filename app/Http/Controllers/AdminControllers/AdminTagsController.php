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
            'tags' => Tag::with('posts')->latest()->paginate(100),
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
        $tag->posts()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag has been Deleted');
    }
}
