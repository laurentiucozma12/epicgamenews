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
        'thumbnail' => 'required|image|dimensions:max_width=1800,max_height=900',
        'author_thumbnail' => 'required|max:150',
        'body' => 'required',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::latest()->with(['category'])->paginate(100),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $selectedCategory = $request->input('category_id'); // 1 is uncategorized
        $selectedPlatforms = $request->input('platforms', []); // 1 is uncategorized
        $selectedOther = $request->input('other_id'); // 1 is uncategorized

        if (($selectedCategory !== "1" && $selectedPlatforms[0] !== '1' &&  $selectedOther === "1") 
        || ($selectedCategory === "1" && $selectedPlatforms[0] === '1' &&  $selectedOther !== "1")) {
            $validated = $request->validate($this->rules);
            
            $validated['user_id'] = auth()->id();
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

            // Attach platform IDs to the post
            $post->platforms()->attach($selectedPlatforms);
            
            // Set other IDs to the post
            $post->update(['other_id' => $selectedOther]);

            $tags = explode(',', $request->input('tags'));
            $tags_ids = [];
            foreach ($tags as $tag) {
                $tag = strtolower(trim($tag)); // Convert to lowercase
                $existingTag = Tag::firstOrNew(['name' => $tag]);

                if (!$existingTag->exists) {
                    $existingTag->save();
                }

                $tags_ids[] = $existingTag->id;
            }

            $post->tags()->sync($tags_ids);
            
            return redirect()->route('admin.posts.create')->with('success', 'Post has been created.');
        } else  {        
            return redirect()->back()->withInput()->withErrors(['all_fields' => 
                'Articles about games must be posted in category & platforms. Everything else in "other" section.
                Also do not forget to remove "uncategorized" from platforms section after you choose at least one option.
                Example 1: An article about Skyrim goes in RPG Category and PC, PlayStation, Xbox and other must be set on "uncategorized".
                Example 2: An article about a Game Trailer/Movie/Game-Trailer/etc. goes in "Other" section, and Category and Platforms must be set on "uncategorized"
            ']);
        }
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

        // Pass all the platforms
        $platforms = Platform::pluck('name', 'id');

        // Pass the selected platforms
        $selectedPlatformIds = $post->platforms->pluck('id')->toArray();
        
        return view('admin_dashboard.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'categories' => Category::pluck('name', 'id'),
            'others' => Other::pluck('name', 'id'),
            'platforms' => $platforms,
            'selectedPlatformIds' => $selectedPlatformIds,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $selectedCategory = $request->input('category_id'); // 1 is uncategorized
        $selectedPlatforms = $request->input('platforms', []); // 1 is uncategorized
        $selectedOther = $request->input('other_id'); // 1 is uncategorized
        
        if (($selectedCategory !== "1" && $selectedPlatforms[0] !== '1' &&  $selectedOther === "1") 
            || ($selectedCategory === "1" && $selectedPlatforms[0] === '1' &&  $selectedOther !== "1")) {
            // An article about a GAME must have 1 CATEGORY and at least 1 PLATFORM that is played on.
            // If the article is about something else, it has to be posted in OTHER.
            // Get the selected platform names from the request
            $this->rules['thumbnail'] = 'nullable|image|dimensions:max_width=1800,max_height=900';
            $validated = $request->validate($this->rules);
            $validated['approved'] = $request->input('approved') !== null;
            
            $post->update($validated);

            if ($request->has('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $filename = $thumbnail->getClientOriginalName();
                $file_extension = $thumbnail->getClientOriginalExtension();
                $path = $thumbnail->store('images', 'public');

                $post->image()->update([
                    'name' => $filename,
                    'extension' => $file_extension,
                    'path' => $path,
                ]);
            }

            $platformIds = $request->input('platforms', []);

            // Sync the new platforms
            $post->platforms()->sync($platformIds);

            $tags = explode(',', $request->input('tags'));
            $tags_ids = [];
            foreach ($tags as $tag) {
                $tag = strtolower(trim($tag)); // Convert to lowercase
                $existingTag = Tag::firstOrNew(['name' => $tag]);

                if (!$existingTag->exists) {
                    $existingTag->save();
                }

                $tags_ids[] = $existingTag->id;
            }

            $post->tags()->sync($tags_ids);        
            
            // Save the changes to the post
            $post->other_id = $selectedOther;
            $post->save();    

            return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been updated with success');
        } else  {        
            return redirect()->back()->withInput()->withErrors(['all_fields' => 
                'Articles about games must be posted in category & platforms. Everything else in "other" section.
                Also do not forget to remove "uncategorized" from platforms section after you choose at least one option.
                Example 1: An article about Skyrim goes in RPG Category and PC, PlayStation, Xbox and other must be set on "uncategorized".
                Example 2: An article about a Game Trailer/Movie/Game-Trailer/etc. goes in "Other" section, and Category and Platforms must be set on "uncategorized"
            ']);
        }
    }

    public function destroy(Post $post)
    {
        $post->tags()->delete();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post has been deleted');
    }
}