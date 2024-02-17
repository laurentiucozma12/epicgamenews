<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Seo;
use App\Models\Image;
use App\Models\Category;

use App\Models\Platform;
use App\Models\VideoGame;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminVideoGamesController extends Controller
{
    private $rules = [
        'seo_title' => 'required|min:2|max:250',
        'seo_description' => 'required|min:2|max:300',
        'seo_keywords' => 'required|min:2|max:255',
        'name' => 'required|min:2|max:250',
        'slug' => 'required|unique:video_games,slug|max:150',
        'thumbnail' => 'required|image|max:1920',
    ];
    
    public function index()
    {
        $video_games = VideoGame::with('user')->orderBy('id', 'DESC')->paginate(100);

        return view('admin_dashboard.video_games.index', [
            'video_games' => $video_games
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.video_games.create', [
            'categories' => Category::all(),
            'platforms' => Platform::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $video_game = VideoGame::create($validated);

        // Create SEO entry
        if ($request->has('name') && $request->has('seo_description')) {
            $seoData = [
                'page_name' => 'Related Video Game',
                'page_type' => 'video_game',
                'seo_name' => $video_game->name,
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_keywords' => $request->input('seo_keywords'),
            ];

            $video_game->seo()->create($seoData);
        }
        
        // Attach categories to the video game
        if ($request->has('categories_ids') && is_array($request->categories_ids)) {
            $video_game->categories()->attach($request->categories_ids);
        }

        // Attach platforms to the video game
        if ($request->has('platforms_ids') && is_array($request->platforms_ids)) {
            $video_game->platforms()->attach($request->platforms_ids);
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
            $video_game->image()->create($image_data);
        }

        return redirect()->route('admin.video_games.create')->with('success', 'Video Game has been Created');
    }

    public function show(VideoGame $video_game)
    {
        $posts = $video_game->posts()->latest()->paginate(100);
        
        return view('admin_dashboard.video_games.show', [
            'video_game' => $video_game,
            'posts' => $posts,
        ]);
    }

    public function edit(VideoGame $video_game)
    {
        $seo = Seo::where('video_game_id', $video_game->id)->first();

        // Pass all the SELECTED video_game, categories, platforms
        $categories = Category::pluck('categories.name', 'categories.id');
        $platforms = Platform::pluck('platforms.name', 'platforms.id');

        // Pass the selected categories and platforms
        $selectedCategFormIds = $video_game->categories->pluck('id')->toArray();
        $selectedPlatFormIds = $video_game->platforms->pluck('id')->toArray();

        return view('admin_dashboard.video_games.edit', [
            'seo' => $seo,
            'video_game' => $video_game,
            'categories' => $categories,
            'selectedCategFormIds' => $selectedCategFormIds,
            'platforms' => $platforms,
            'selectedPlatFormIds' => $selectedPlatFormIds,
        ]);
    }

    public function update(Request $request, VideoGame $video_game)
    {
        $this->rules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('video_games')->ignore($video_game)];
        $validated = $request->validate($this->rules);
        $validated['deleted'] = $request->has('deleted') ? 0 : 1;
        
        // Update the video game details
        $video_game->update($validated);

        // Update SEO entry
        if ($request->has('seo_title') && $request->has('seo_description')) {
            $seoData = [
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_keywords' => $request->input('seo_keywords'),
            ];

            // Check if SEO entry already exists
            $seo = $video_game->seo;

            $seo->update($seoData);
        }
        
        // Update the categories
        if ($request->has('categories_ids')) {
            $video_game->categories()->sync($request->input('categories_ids'));
        }

        // Update the platforms
        if ($request->has('platforms_ids')) {
            $video_game->platforms()->sync($request->input('platforms_ids'));
        }

        // Update the thumbnail
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
            $newImage = $video_game->image()->create($imageData);

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
            
            $adminCropResizeImage->deleteOldImages($video_game, $folders);
        }

        return redirect()->route('admin.video_games.edit', $video_game)->with('success', 'Video Game has been Updated');
    }

    public function destroy(VideoGame $video_game)
    {
        $video_game->deleted = 1;
        $video_game->save();
        
        return redirect()->route('admin.video_games.index')->with('danger', 'Video Game has been Dezactivated');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $video_games = VideoGame::where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('categories', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('platforms', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('user', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(100);

        return view('admin_dashboard.video_games.index', compact('video_games', 'search'));
    }

    public function createApi()
    {
        return view('admin_dashboard.video_games.create_api');
    }

    public function storeApi(Request $request)
    {
        // Find video game by slug, Returns the Instance of the Model OR null
        $game_exists = VideoGame::where('slug', $request->game_slug)->first();

        if ($game_exists) {
            return redirect()->back()->with('danger', 'Video Game already exists in Database'); 
        }

        // Store the video game data
        $validatedData = [
            'name' => $request->game_name,
            'slug' => $request->game_slug,
            'user_id' => auth()->id(),
        ];
        $video_game = VideoGame::create($validatedData);

        $video_game_id = $video_game->id;
        $imageable_type = 'App\Models\VideoGame';
        $this->createImage($video_game_id, $imageable_type);

        // Create SEO entry
        if ($video_game) {
            $seoData = [
                'page_type' => 'video_game',
                'page_name' => 'Related Video Game',
                'seo_name' => $video_game->name,
                'seo_title' => 'News about ' . $video_game->name . ' Video Game | Epic Game News',                
                'seo_description' => 'Find gaming news filtered by the ' . $video_game->name . ' Video Game, only at Epic Game News',
                'seo_keywords' => $video_game->name,
            ];

            $video_game->seo()->create($seoData);
        }

        // Attach genres to the video game
        $genres_names = explode(',', $request->genres_names);

        // Remove spaces
        $genres_names = array_map('trim', $genres_names);
        
        foreach ($genres_names as $index => $genre_name) {
            // Find category by slug, Returns the Instance of the Model OR null
            $genre_slug = strtolower(str_replace(' ', '-', $genres_names[$index]));
            $category = Category::where('slug', $genre_slug)->first();
            
            // If category is new, save it and attach to the video game
            if ($category === null) {
                $category = Category::create([
                    'name' => $genre_name,
                    'slug' => $genre_slug,
                    'user_id' => auth()->id(),
                ]);

                $category_id = $category->id;
                $imageable_type = 'App\Models\Category';
                $this->createImage($category_id, $imageable_type);

                // Create SEO entry for the category
                $seoData = [
                    'page_type' => 'category',
                    'page_name' => 'Related Category',
                    'seo_name' => $category->name,
                    'seo_title' => 'Gaming news related to ' . $category->name . ' category | Epic Game News',                
                    'seo_description' => 'Find gaming news filtered by the ' . $category->name . ' category, only at Epic Game News',
                    'seo_keywords' => $category->name,
                ];

                $category->seo()->create($seoData);

            }

            // Attach the category to the video game
            $video_game->categories()->attach($category->id);
        }

        // Attach platforms to the video game
        $platforms_names = explode(',', $request->platforms_names);
            
        // Remove spaces
        $platforms_names = array_map('trim', $platforms_names);

        foreach ($platforms_names as $index => $platform_name) {
            // Find platform by slug, Returns the Instance of the Model OR null          
            $platform_slug = strtolower(str_replace(' ', '-', $platforms_names[$index]));
            $platform = Platform::where('slug', $platform_slug)->first();

            // If platform doesn't exist, create it
            if ($platform === null) {
                
                $platform = Platform::create([
                    'name' => $platform_name,
                    'slug' => $platform_slug,
                    'user_id' => auth()->id(),
                ]);

                $platform_id = $platform->id;
                $imageable_type = 'App\Models\Platform';
                $this->createImage($platform_id, $imageable_type);

                $seoData = [
                    'page_type' => 'platform',
                    'page_name' => 'Related Platform',
                    'seo_name' => $platform->name,
                    'seo_title' => 'Gaming news related to ' . $platform->name . ' platform | Epic Game News',                
                    'seo_description' => 'Find gaming news filtered by the ' . $platform->name . ' platform, only at at Epic Game News',
                    'seo_keywords' => $platform->name,
                ];
                
                $platform->seo()->create($seoData);
                
            }
            
            // Attach the platform to the video game
            $video_game->platforms()->attach($platform->id);
        }

        return redirect()->route('admin.video_games.create_api')->with('success', 'Video Game has been Created');            
    }

    private  function createImage($imageable_id, $imageable_type) {  
        $name = 'thumbnail_placeholder.jpg';
        $extension = 'jpg';

        $image = new Image([
            'name' => $name,
            'extension' => $extension,
        ]);

        $image->imageable_id = $imageable_id;
        $image->imageable_type = $imageable_type;
        $image->save();
    }
}