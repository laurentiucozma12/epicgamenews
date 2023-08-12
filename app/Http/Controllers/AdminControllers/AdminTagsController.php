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
            'tags' => Tag::with('posts')->paginate(50),
        ]);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show(Tag $tag)
    {
        return view('admin_dashboard.tags.show', [
            'tag' => $tag
        ]);
    }

    public function edit(Tag $tag)
    {
        //
    }

    public function update(Request $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Tag has been Deleted');
    }
}
