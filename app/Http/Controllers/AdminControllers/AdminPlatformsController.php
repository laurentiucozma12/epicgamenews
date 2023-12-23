<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Platform;

class AdminPlatformsController extends Controller
{ 
    private $rules = [
        'name' => 'required|min:2|max:30',
        'slug' => 'required|unique:platforms,slug|max:150',
        'thumbnail' => 'required|image|max:1920',
    ];

    public function index()
    {
        $platforms = Platform::with('user')->orderBy('id', 'DESC')->paginate(100);
        
        return view('admin_dashboard.platforms.index', [
            'platforms' => $platforms
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.platforms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $platform = Platform::create($validated);

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
            $platform->image()->create($image_data);
        }

        return redirect()->route('admin.platforms.create')->with('success', 'Platform has been Created');
    }

    public function show(Platform $platform)
    {
        $video_games = $platform->videoGames()->latest()->paginate(100);
    
        return view('admin_dashboard.platforms.show', [
            'platform' => $platform,
            'video_games' => $video_games,
        ]);
    }

    public function edit(Platform $platform)
    {
        return view('admin_dashboard.platforms.edit', [
            'platform' => $platform
        ]);
    }

    public function update(Request $request, Platform $platform)
    {
        $this->rules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('platforms')->ignore($platform)];
        $validated = $request->validate($this->rules);

        // Update the category details
        $platform->update($validated);

        // Check if a new image has been uploaded
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
            $newImage = $platform->image()->create($imageData);

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
            
            $adminCropResizeImage->deleteOldImages($platform, $folders);
        }

        return redirect()->route('admin.platforms.edit', $platform)->with('success', 'Platform has been Updated');
    }

    public function destroy(Platform $platform)
    {
        $platform->deleted = 1;
        $platform->save();
        
        return redirect()->route('admin.platforms.index')->with('danger', 'Platform has been Dezactivated');
    }
}
