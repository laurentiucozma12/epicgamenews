<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Platform;
use App\Models\Seo;

class AdminPlatformsController extends Controller
{ 
    private $rules = [
        'seo_title' => 'required|min:2|max:250',
        'seo_description' => 'required|min:2|max:300',
        'seo_keywords' => 'required|min:2|max:255',
        'name' => 'required|min:2|max:250',
        'slug' => 'required|unique:platforms,slug|max:150',
        'thumbnail' => 'required|mimes:jpeg,png,webp,avif|max:50000',
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

        // Create SEO entry
        if ($request->has('seo_title') && $request->has('seo_description')) {
            $seoData = [
                'page_name' => 'Related Platform',
                'page_type' => 'platform',
                'seo_name' => $platform->name,
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_keywords' => $request->input('seo_keywords'),
            ];

            $platform->seo()->create($seoData);
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
        $seo = Seo::where('platform_id', $platform->id)->first();

        return view('admin_dashboard.platforms.edit', [
            'seo' => $seo,
            'platform' => $platform
        ]);
    }

    public function update(Request $request, Platform $platform)
    {
        $this->rules['thumbnail'] = 'nullable|mimes:jpeg,png,webp,avif|max:50000';
        $this->rules['slug'] = ['required', Rule::unique('platforms')->ignore($platform)];
        $validated = $request->validate($this->rules);
        $validated['deleted'] = $request->has('deleted') ? 0 : 1;

        // Update the category details
        $platform->update($validated);

        // Update SEO entry
        if ($request->has('seo_title') && $request->has('seo_description')) {
            $seoData = [
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_keywords' => $request->input('seo_keywords'),
            ];

            // Check if SEO entry already exists
            $seo = $platform->seo;

            $seo->update($seoData);
        }

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

    public function search(Request $request)
    {
        $search = $request->search;

        $platforms = Platform::where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('user', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(100);

        return view('admin_dashboard.platforms.index', compact('platforms', 'search'));
    }
}
