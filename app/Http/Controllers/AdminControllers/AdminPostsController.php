<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Seo;

use App\Models\Tag;

use App\Models\Post; 
use App\Models\Category;
use App\Models\Platform;

use App\Models\VideoGame;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminControllers\AdminCropResizeImage;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'max:250',
        'slug' => 'required|unique:posts|min:4|max:150',
        'excerpt' => 'max:300',
        'video_game_id' => 'numeric',
        'thumbnail' => 'image|max:1920',
        'author_thumbnail' => 'max:150',
        'body' => 'max:10000',
    ];

    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(100);

        return view('admin_dashboard.posts.index', [
            'posts' => $posts,
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

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);        
        $validated['user_id'] = auth()->id();
        
        // Set default values for seo_title and seo_description if not provided
        $seo_title = $request->input('title') ?? 'NoTitleNoSeoTitleYet';
        $seo_description = $request->input('excerpt') ?? 'NoExcerptNoSeoDescriptionYet';

        $post = Post::create($validated);
        
        // Create SEO entry
        if ($request->has('title') && $request->has('excerpt')) {
            $seoData = [
                'page_type' => 'post',
                'page_name' => 'Post',
                'seo_name' => $post->video_game->name,
                'seo_title' => $seo_title,
                'seo_description' => $seo_description,
                'seo_keywords' => $request->input('tags'),
            ];

            $post->seo()->create($seoData);
        }

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
       
        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been created with success');
    }

    public function edit(Post $post)
    {
        $seo = Seo::where('post_id', $post->id)->first();
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
            'seo' => $seo,
            'post' => $post,
            'tags' => $tags,
            'video_games' => $video_games,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->rules['slug'] = ['required', Rule::unique('posts')->ignore($post)];
        $validated = $request->validate($this->rules);
        $validated['deleted'] = $request->has('deleted') ? 0 : 1;
        
        // Set default values for seo_title and seo_description if not provided
        $seo_title = $request->input('title') ?? 'NoTitleNoSeoTitleYet';
        $seo_description = $request->input('excerpt') ?? 'NoExcerptNoSeoDescriptionYet';

        $post->update($validated);

        // Update SEO entry
        if ($request->has('title') && $request->has('excerpt')) {
            $seoData = [
                'seo_title' => $seo_title,
                'seo_description' => $seo_description,
                'seo_keywords' => $request->input('tags'),
            ];

            // Check if SEO entry already exists
            $seo = $post->seo;

            $seo->update($seoData);
        }

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

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where(function($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('excerpt', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        })
        ->orWhereHas('video_game', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('video_game.categories', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('video_game.platforms', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('author', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(100);

        return view('admin_dashboard.posts.index', compact('posts', 'search'));
    }

    public function createApi()
    {
        // IN DEVELOPMENT, NOT ENOUGH FOUND
        // 25$/month: zylalabs.com
        // https://zylalabs.com/api-marketplace/video+games/games+top+news+api/2287
        return view('admin_dashboard.posts.create_api');
    }

    public function storeApi(Request $request)
    {
        // IN DEVELOPMENT, NOT ENOUGH FOUND
        // 25$/month: zylalabs.com
        // https://zylalabs.com/api-marketplace/video+games/games+top+news+api/2287
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

            // Create SEO entry for the tag
            $seoData = [
                'page_type' => 'tag',
                'page_name' => 'Related Tag',
                'seo_name' => $existingTag->name,
                'seo_title' => 'Gaming news related to  ' . $existingTag->name . ' tag | Epic Game News',
                'seo_description' => 'Find gaming news filtered by the ' . $existingTag->name . ' tag, only at Epic Game News',
                'seo_keywords' => $existingTag->name,
            ];

            $existingTag->seo()->updateOrCreate([], $seoData);

            $tags_ids[] = $existingTag->id;
        }
        
        $post->tags()->sync($tags_ids);
    }
}