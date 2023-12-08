<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Tag;

use App\Models\Other;
use App\Models\Post; 

use App\Models\Category;
use App\Models\Platform;
use App\Models\VideoGame;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminControllers\AdminCropResizeImage;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:150',
        'slug' => 'required|max:150',
        'excerpt' => 'required|max:400',
        'video_game_id' => 'required|numeric',
        'thumbnail' => 'required|image|max:1920',
        'author_thumbnail' => 'nullable|max:150',
        'body' => 'required',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::latest()->paginate(100),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'video_games' => VideoGame::all(),            
            'categories' => Category::all(),
            'platforms' => Platform::all(),
            'others' => Other::all(),
        ]);
    }

    public function store(Request $request)
    {
        if ($this->validateArticleData($request)) {

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

            // Attach categories and platforms IDs to the post
            $post->categories()->attach($request->input('categories_ids', []));
            $post->platforms()->attach($request->input('platforms_ids', []));
            
            // Set video game and other IDs to the post
            $post->update([
                'video_game_id' => $request->input('video_game_id'),
                'other_id' => $request->input('other_id')
            ]);

            $this->syncTags($request, $post);            

            return redirect()->route('admin.posts.create')->with('success', 'Post has been created.');
        } else {
            return redirect()->back()->withInput()->withErrors($this->buildValidationErrorMessage());
        }

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

        // Pass all the SELECTED video_game, categories, platforms, other
        $video_games = VideoGame::pluck('name', 'id');
        $categories = Category::pluck('categories.name', 'categories.id');
        $platforms = Platform::pluck('platforms.name', 'platforms.id');
        $others = Other::pluck('name', 'id');

        // Pass the selected categories and platforms
        $selectedCategFormIds = $post->categories->pluck('id')->toArray();
        $selectedPlatFormIds = $post->platforms->pluck('id')->toArray();
        
        return view('admin_dashboard.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'video_games' => $video_games,
            'categories' => $categories,
            'selectedCategFormIds' => $selectedCategFormIds,
            'platforms' => $platforms,
            'selectedPlatFormIds' => $selectedPlatFormIds,
            'others' => $others,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        if ($this->validateArticleData($request)) {

            $this->rules['thumbnail'] = 'nullable|image|max:1920';
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
            
            // Sync the new categories and platforms
            $post->categories()->sync($request->input('categories_ids', []));
            $post->platforms()->sync($request->input('platforms_ids', []));

            // Save the changes to the post
            $post->video_game_id = $request->input('video_game_id');
            $post->other_id = $request->input('other_id');
            $post->save();

            return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been updated with success');
        } else {
            return redirect()->back()->withInput()->withErrors($this->buildValidationErrorMessage());
        }
    }

    public function destroy(Post $post)
    {
        $post->deleted = 1; 
        $post->save();

        return redirect()->route('admin.posts.index')->with('danger', 'Post has been dezactivated');
    }

    private function validateArticleData(Request $request) {
        $selectedVideoGame = $request->input('video_game_id'); // 1 is uncategorized
        $selectedCategories = $request->input('categories_ids', []); // 1 is uncategorized
        $selectedPlatforms = $request->input('platforms_ids', []); // 1 is uncategorized
        $selectedOther = $request->input('other_id'); // 1 is uncategorized
        
        // game name, categories of the game and plaforms that can be played on are required
        // or game name and other if the article is about something else related to a game (like an anime/movie/etc. based on a game)
        if (
            (intval($selectedVideoGame) !== 1 && intval($selectedCategories[0]) !== 1 && intval($selectedPlatforms[0]) !== 1 && intval($selectedOther) === 1) ||
            (intval($selectedVideoGame) !== 1 && intval($selectedCategories[0]) === 1 && intval($selectedPlatforms[0]) === 1 && intval($selectedOther) !== 1)
        ) {
            return true;
        }
    
        return false;
    }

    private function buildValidationErrorMessage() {
        return [
            'all_fields' => '
                Articles must have a (video game, categories, and platforms) OR (video game and others).
                Also, do not forget to remove "uncategorized" from categories and platforms sections after you choose at least one option.
                Example 1: An article about Witcher 3 goes in Witcher 3 (video game field), RPG & Action (categories field), PC & PlayStation & Xbox (platforms field), (and the other field must be set to "uncategorized").
                Example 2: An article about Witcher from the Netflix Series goes in Witcher 3 (video game field), Series (other field), (and the rest remain uncategorized).
            ',
        ];
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