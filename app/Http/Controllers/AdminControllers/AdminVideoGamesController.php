<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\VideoGame;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminVideoGamesController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|max:30',
        'slug' => 'required|unique:others,slug',
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
        return view('admin_dashboard.video_games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $video_game = VideoGame::create($validated);

        if ($request->hasFile('thumbnail')) {
            // Store is the folder name where images will be saved
            $store = 'images';
            $maxWidth = 480;
            $maxHeight = 270;
            
            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->optimizeImage($request, $maxWidth, $maxHeight, $store);
            $video_game->image()->create($imageData);
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
        return view('admin_dashboard.video_games.edit', [
            'video_game' => $video_game
        ]);
    }

    public function update(Request $request, VideoGame $video_game)
    {
        $this->rules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('video_games')->ignore($video_game)];
        $validated = $request->validate($this->rules);
        $video_game->update($validated);

        if ($request->hasFile('thumbnail')) {
            // Store is the folder name where images will be saved
            $store = 'images';
            $maxWidth = 480;
            $maxHeight = 270;
            
            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->optimizeImage($request, $maxWidth, $maxHeight, $store);
            $newImage = $video_game->image()->create($imageData);

            // Get the ID of the newly associated image
            $newImageId = $newImage->id;

            // Delete the old img
            $adminCropResizeImage->deleteOldImage($video_game);
        }

        return redirect()->route('admin.video_games.edit', $video_game)->with('success', 'Video Game has been Updated');
    }

    public function destroy(VideoGame $video_game)
    {
        if ($video_game->name === 'uncategorized')
            return redirect()->route('admin.video_games.index')->with('danger', 'You can not delete uncategorized one');

        $video_game->deleted = 1;
        $video_game->save();
        
        return redirect()->route('admin.video_games.index')->with('danger', 'Video Game has been Dezactivated');
    }
}
