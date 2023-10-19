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
            $adminCropResizeImage = new AdminCropResizeImage();
            $store = 'platforms';
            $maxWidth = 720;
            $maxHeight = 405;
            $imageData = $adminCropResizeImage->cropResizeImage($request, $maxWidth, $maxHeight, $store);
            $platform->image()->create($imageData);
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
        $updateRules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('platforms')->ignore($platform)];
        $validated = $request->validate($this->rules);
        $platform->update($validated);

        if ($request->hasFile('thumbnail')) {
            $store = 'platforms';
            $maxWidth = 720;
            $maxHeight = 405;
            
            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->cropResizeImage($request, $maxWidth, $maxHeight, $store);
            $platform->image()->update($imageData);          
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
