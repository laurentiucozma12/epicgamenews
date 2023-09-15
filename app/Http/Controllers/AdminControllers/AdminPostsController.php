<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;
use App\Models\Post;
use App\Models\Tag;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:150',
        'slug' => 'required|max:150',
        'excerpt' => 'required|max:150',
        'category_id' => 'required|numeric',
        'other_id' => 'required|numeric',
        'thumbnail' => 'required|image|dimensions:max_width=1800,max_height=900',
        'body' => 'required',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::latest()->with(['category', 'other'])->get(),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'categories' => Category::all(),
            'others' => Other::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        
        $validated['user_id'] = auth()->id();
        // dd($request->category_id, $request->platform_id, $request->other_id);
        // I get the id for category and other, but for platform I get null, so I have to rethink this one
        // if (($request->category_id + $request->platform_id + $request->other_id) === 3) {
        //     return redirect()->back()->withInput()->withErrors(['all_fields' => 'At least one field from Category/Platform/Other must be different than "uncategorized."']);
        // } else {
            $post = Post::create($validated);

            if ($request->has('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $filename = $thumbnail->getClientOriginalName();
                $file_extension = $thumbnail->getClientOriginalExtension();
                $path = $thumbnail->store('images', 'public');
        
                $post->image()->create([
                    'name' => $filename,
                    'extension' => $file_extension,
                    'path' => $path,
                ]);
            }

            $selectedPlatforms = $request->input('platforms', []);
            $platformIds = [];
            // Map platform names to their corresponding IDs
            foreach ($selectedPlatforms as $selectedPlatform) {
                switch ($selectedPlatform) {
                    case 'uncategorized':
                        $platformIds[] = 1;
                        break;
                    case 'pc':
                        $platformIds[] = 2;
                        break;
                    case 'playstation':
                        $platformIds[] = 3;
                        break;
                    case 'xbox':
                        $platformIds[] = 4;
                        break;
                    case 'mobile':
                        $platformIds[] = 5;
                        break;
                    case 'nintendo':
                        $platformIds[] = 6;
                        break;
                }
            }

            // Attach platform IDs to the post
            $post->platforms()->attach($platformIds);

            
            $tags = explode(',', $request->input('tags'));
            $tags_ids = [];
            foreach ($tags as $tag) {
                $existingTag = Tag::firstOrNew(['name' => trim($tag)]);

                if (!$existingTag->exists) {
                    $existingTag->save();
                }
            
                $tags_ids[] = $existingTag->id;
            }
            
            $post->tags()->sync($tags_ids);
            
            return redirect()->route('admin.posts.create')->with('success', 'Post has been created.');
        // } // end from // if (($request->category_id + $request->platform_id + $request->other_id) === 3)
    }


    public function show(string $id)
    {
        //
    }

    public function edit(Post $post)
    {
        $tags = '';
        foreach ($post->tags as $key => $tag)
        {
            $tags .= $tag->name;
            if ($key !== count($post->tags) - 1) 
                $tags .= ', ';
        }

        return view('admin_dashboard.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'categories' => Category::pluck('name', 'id'),
            'platforms' => Platform::pluck('name', 'id'),
            'others' => Other::pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|image|dimensions:max_width=1800,max_height=900';
        $validated = $request->validate($this->rules);
        $validated['approved'] = $request->input('approved') !== null;

        $post->update($validated);

        if ($request->has('thumbnail')) {
            // Your thumbnail handling code here
        }

        $platformNames = explode(',', $request->input('platforms'));
        $platformIds = [];

        foreach ($platformNames as $platformName) {
            // Find the existing platform by name
            $existingPlatform = Platform::where('name', trim($platformName))->first();

            if ($existingPlatform) {
                // If the platform exists, use its ID
                $platformIds[] = $existingPlatform->id;
            }
        }

        if (count($platformIds) > 0) {
            $post->platforms()->sync($platformIds);
        }

        $tags = explode(',', $request->input('tags'));
        $tags_ids = [];

        foreach($tags as $tag){
            $tag_exist = $post->tags()->where('name', trim($tag))->count();
            if($tag_exist == 0) {
                $tag_ob = Tag::create(['name' => $tag]);
                $tags_ids[] = $tag_ob->id;
            }
        }      

        if (count($tags_ids) > 0) {
            $post->tags()->sync($tags_ids);
        }

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been updated');
    }

    public function destroy(Post $post)
    {
        $post->tags()->delete();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post has been deleted');
    }
}
