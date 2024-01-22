<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Tag;

use App\Models\Post; 

use App\Models\Category;
use App\Models\Platform;
use App\Models\VideoGame;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;
use App\Http\Controllers\AdminControllers\AdminCropResizeImage;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:150',
        'slug' => 'required|unique:posts,slug|max:150',
        'excerpt' => 'required|max:400',
        'video_game_id' => 'required|numeric',
        'thumbnail' => 'required|image|max:1920',
        'author_thumbnail' => 'nullable|max:150',
        'body' => 'required',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::orderBy('id', 'DESC')->paginate(100),
        ]);
    }

    public function create()
    {
        $video_games = VideoGame::all()
            ->where('deleted', 0);
        
        return view('admin_dashboard.posts.create', [
            'video_games' => $video_games
        ]);
    }

    public function scrapPost()
    {        
        $video_games = VideoGame::all()
            ->where('deleted', 0);

        return view('admin_dashboard.posts.scrap_post', [
            'video_games' => $video_games
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);        
        $validated['user_id'] = auth()->id();
        $post = Post::create($validated);

        if ($request->hasFile('thumbnail')) {
            $sizes = [
                [1140, 641],
                [943, 530],
                [764, 431],
                [480, 270],
                [342, 192],
                [400, 225],
                [300, 169],
                [146, 82],
            ];

            // Upload and save the new images
            $adminCropResizeImage = new AdminCropResizeImage();
            $image_data = $adminCropResizeImage->optimizeImage($request, $sizes);
            $post->image()->create($image_data);
        }
        
        // Set video game IDs to the post
        $post->update([
            'video_game_id' => $request->input('video_game_id'),
        ]);

        $this->syncTags($request, $post);            

        return redirect()->route('admin.posts.create')->with('success', 'Post has been created.');
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

        // Pass the SELECTED video_game
        $video_games = VideoGame::pluck('name', 'id');
        
        return view('admin_dashboard.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'video_games' => $video_games,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('posts')->ignore($post)];
        $validated = $request->validate($this->rules);
        $validated['deleted'] = $request->has('deleted') ? 0 : 1;
        $post->update($validated);

        if ($request->hasFile('thumbnail')) {                
            $sizes = [
                [1140, 641],
                [943, 530],
                [764, 431],
                [480, 270],
                [342, 192],
                [400, 225],
                [300, 169],
                [146, 82],
            ];

            // Upload and save the new images
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->optimizeImage($request, $sizes);
            $newImage = $post->image()->create($imageData);

            // Get the ID of the newly associated image
            $newImageId = $newImage->id;

            $folders = [
                'images/1140x641',
                'images/943x530',
                'images/764x431',
                'images/480X270',
                'images/342x192',
                'images/400x225',
                'images/300x169',
                'images/146x82',                    
            ];
            
            $adminCropResizeImage->deleteOldImages($post, $folders);
        }

        $this->syncTags($request, $post);

        // Save the changes to the post
        $post->video_game_id = $request->input('video_game_id');
        $post->save();

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been updated with success');
    }

    public function destroy(Post $post)
    {
        $post->deleted = 1; 
        $post->save();

        return redirect()->route('admin.posts.index')->with('danger', 'Post has been dezactivated');
    }

    private function syncTags($request, $post)
    { 
        $tags = explode(',', $request->input('tags'));
        $tags_ids = [];
        foreach ($tags as $tag) {
            $tag = strtolower(trim($tag)); // Convert to lowercase
            $existingTag = Tag::firstOrNew(['name' => $tag]);
            
            if (!$existingTag->exists) {
                $existingTag->name = $tag;
                $existingTag->slug = Str::slug($tag, '-');
                $existingTag->user_id = auth()->id();
                $existingTag->save();
            }
            
            $tags_ids[] = $existingTag->id;
        }
        
        $post->tags()->sync($tags_ids);
    }
}