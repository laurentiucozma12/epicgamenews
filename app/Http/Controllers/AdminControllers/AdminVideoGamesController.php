<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Category;
use App\Models\Platform;
use App\Models\VideoGame;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminVideoGamesController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|max:30',
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
        // Pass all the SELECTED video_game, categories, platforms
        $categories = Category::pluck('categories.name', 'categories.id');
        $platforms = Platform::pluck('platforms.name', 'platforms.id');

        // Pass the selected categories and platforms
        $selectedCategFormIds = $video_game->categories->pluck('id')->toArray();
        $selectedPlatFormIds = $video_game->platforms->pluck('id')->toArray();

        return view('admin_dashboard.video_games.edit', [
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
}
