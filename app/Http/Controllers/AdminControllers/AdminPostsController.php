<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;
use App\Models\Post;

////  Delete after testing
    use Illuminate\Support\Facades\Log;
////

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:200',
        'slug' => 'required|max:200',
        'excerpt' => 'required|max:1000',
        'category_id' => 'required|numeric',
        'platform_id' => 'required|numeric',
        'other_id' => 'required|numeric',
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
            'others' => Other::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {

        if(!$request->has('title')) {
            Log::debug('title field is not present in the request data.');
        }
        if (!$request->has('slug')) {
            Log::debug('slug field is not present in the request data.');        
        }
        if (!$request->has('excerpt')) {
            Log::debug('excerpt field is not present in the request data.');        
        }
        if (!$request->has('category_id')) {
            Log::debug('category_id field is not present in the request data.');        
        }
        if (!$request->has('platform_id')) {
            Log::debug('platform_id field is not present in the request data.');        
        }
        if (!$request->has('other_id')) {
            Log::debug('Other_id field is not present in the request data.');        
        }
        if (!$request->has('thumbnail')) {
            Log::debug('thumbnail field is not present in the request data.');        
        }
        if (!$request->has('body')) {
            Log::debug('body field is not present in the request data.');        
        }
        Log::debug('Reached this point 1');

        $validated = $request->validate($this->rules);

        Log::debug('Reached this point 2');

        $validated['user_id'] = auth()->id();     

        $post = Post::create($validated);  

        Log::debug('Reached this point 3');
        Log::debug('Validated data:', $validated);

        if($request->has('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }

        return redirect()->route('admin.posts.create')->with('success', 'Post has been created');
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
