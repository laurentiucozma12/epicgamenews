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
        'slug' => 'required|unique:others,slug',
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
                [764, 431],
                [342, 192],
                [400, 225],
                [300, 169],
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
        $posts = $platform->posts()->latest()->paginate(100);
    
        return view('admin_dashboard.platforms.show', [
            'platform' => $platform,
            'posts' => $posts,
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
        $platform->update($validated);

        if ($request->hasFile('thumbnail')) {                
            $sizes = [
                [764, 431],
                [342, 192],
                [400, 225],
                [300, 169],
            ];

            // Upload and save the new images
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->optimizeImage($request, $sizes);
            $newImage = $platform->image()->create($imageData);

            // Get the ID of the newly associated image
            $newImageId = $newImage->id;

            $folders = [
                'images/764x431',
                'images/342x192',
                'images/400x225',
                'images/300x169',                  
            ];
            
            $adminCropResizeImage->deleteOldImages($platform, $folders);
        }

        return redirect()->route('admin.platforms.edit', $platform)->with('success', 'Platform has been Updated');
    }

    public function destroy(Platform $platform)
    {        
        if ($platform->name === 'uncategorized')
            return redirect()->route('admin.platforms.index')->with('danger', 'You can not delete uncategorized one');

        $platform->deleted = 1;
        $platform->save();
        
        return redirect()->route('admin.platforms.index')->with('danger', 'Platform has been Dezactivated');
    }
}
