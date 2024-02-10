<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Seo;
use App\Models\Category;
use App\Models\Platform;

use App\Models\VideoGame;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminVideoGamesController extends Controller
{
    private $rules = [
        'seo_description' => 'required|min:5|max:300',
        'seo_keywords' => 'required|min:5|max:255',
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
                'page_type' => 'Video Game',
                'title' => $request->input('name'),
                'description' => $request->input('seo_description'),
                'keywords' => $request->input('seo_keywords'),
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
        $seo = Seo::where('title', $video_game->name)->first();

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
        
        // Update the video game details
        $video_game->update($validated);

        // Update SEO entry
        if ($request->has('name') && $request->has('seo_description')) {
            $seoData = [
                'title' => $request->input('name'),
                'description' => $request->input('seo_description'),
                'keywords' => $request->input('seo_keywords'),
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

    public function createApi()
    {
        return view('admin_dashboard.video_games.create_api');
    }

    public function storeApi(Request $request)
    {
        // Find video game by slug
        $game_exists = VideoGame::where('slug', $request->game_slug)->first();

        if (!$game_exists) {
            $validated['name'] = $request->game_name;
            $validated['slug'] = $request->game_slug;
            $validated['user_id'] = auth()->id();
            $video_game = VideoGame::create($validated);
            
            // Attach genres to the video game
            $genres_names = explode(',', $request->genres_names);
            $genres_slugs = explode(',', $request->genres_slugs);

            foreach ($genres_names as $index => $genre_name) {
                // Find category by slug
                $category = Category::where('slug', $genres_slugs[$index])->first();
            
                // If category doesn't exist, create it
                if (!$category) {
                    try {
                        $category = Category::create([
                            'name' => $genre_name,
                            'slug' => $genres_slugs[$index],
                            'user_id' => auth()->id(),
                        ]);
                    } catch (\Exception $e) {
                        // Handle the exception, log an error, or return an appropriate response
                        return redirect()->back()->with('danger', 'Error creating category.');
                    }
                }
            
                // Attach the categories to video game
                if ($category) {
                    $video_game->categories()->attach($category->id);
                }
            }

            // Attach platforms to the video game
            $platforms_names = explode(',', $request->platforms_names);
            $platforms_slugs = explode(',', $request->platforms_slugs);

            foreach ($platforms_names as $index => $platform_name) {
                // Find platform by slug
                $platform = Platform::where('slug', $platforms_slugs[$index])->first();
            
                // If platform doesn't exist, create it
                if (!$platform) {
                    try {
                        $platform = Platform::create([
                            'name' => $platform_name,
                            'slug' => $platforms_slugs[$index],
                            'user_id' => auth()->id(),
                        ]);
                    } catch (\Exception $e) {
                        // Handle the exception, log an error, or return an appropriate response
                        return redirect()->back()->with('danger', 'Error creating platform.');
                    }
                }
            
                // Attach the platforms to video game
                if ($platform) {
                    $video_game->platforms()->attach($platform->id);
                }
            }

            return redirect()->route('admin.video_games.index')->with('success', 'Video Game has been Created');            
        } else {
            return redirect()->back()->with('danger', 'Video Game already exists in Database');          
        }
    }
    
}
