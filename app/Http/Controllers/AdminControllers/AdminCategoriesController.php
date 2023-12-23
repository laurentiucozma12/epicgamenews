<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminCategoriesController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|max:30',
        'slug' => 'required|unique:categories,slug|max:150',
        'thumbnail' => 'required|image|max:1920',
    ];
    
    public function index()
    {
        $categories = Category::with('user')->orderBy('id', 'DESC')->paginate(100);
        
        return view('admin_dashboard.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $category = Category::create($validated);

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
            $category->image()->create($image_data);
        }

        return redirect()->route('admin.categories.create')->with('success', 'Category has been Created');
    }

    public function show(Category $category)
    {
        $video_games = $category->videoGames()->latest()->paginate(100);
        
        return view('admin_dashboard.categories.show', [
            'category' => $category,
            'video_games' => $video_games,
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin_dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->rules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('categories')->ignore($category)];
        $validated = $request->validate($this->rules);

        // Update the category details
        $category->update($validated);

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
            $newImage = $category->image()->create($imageData);

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
            
            $adminCropResizeImage->deleteOldImages($category, $folders);
        }

        return redirect()->route('admin.categories.edit', $category)->with('success', 'Category has been Updated');
    }

    public function destroy(Category $category)
    {
        $category->deleted = 1;
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('danger', 'Category has been Dezactivated');
    }
}
