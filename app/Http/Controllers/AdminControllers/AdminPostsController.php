<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Platform;
use App\Models\More;
use App\Models\Post;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:200',
        'slug' => 'required|max:200',
        'excerpt' => 'required|max:300',
        'category_id' => 'required|numeric',
        'platform_id' => 'required|numeric',
        'more_id' => 'required|numeric',
        'thumbnail' => 'required|file|mimes:jpg,png,webp,svg,jpeg',
        'body' => 'required',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index');
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'categories' => Category::pluck('name', 'id'),
            'platforms' => Platform::pluck('name', 'id'),
            'mores' => More::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();

        Post::create($validated);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
