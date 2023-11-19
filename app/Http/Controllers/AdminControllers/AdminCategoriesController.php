<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminCategoriesController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|max:30',
        'slug' => 'required|unique:others,slug',
        'thumbnail' => 'required|image|max:1920',
    ];
    
    public function index()
    {
        $categories = Category::with('user')->orderBy('id', 'DESC')->paginate(100);
        
        return view('admin_dashboard.categories.index', [
            'categories' => $categories
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
            // Store is the folder name where images will be saved
            $store = 'images';
            $maxWidth = 720;
            $maxHeight = 405;
            
            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->optimizeImage($request, $maxWidth, $maxHeight, $store);
            $category->image()->create($imageData);
        }

        return redirect()->route('admin.categories.create')->with('success', 'Category has been Created');
    }

    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(100);
        
        return view('admin_dashboard.categories.show', [
            'category' => $category,
            'posts' => $posts,
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
        $updateRules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('categories')->ignore($category)];
        $validated = $request->validate($this->rules);

        // Update the category details
        $category->update($validated);

        // Check if a new image has been uploaded
        if ($request->hasFile('thumbnail')) {
            // Store is the folder name where images will be saved
            $store = 'images';
            $maxWidth = 720;
            $maxHeight = 405;

            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->optimizeImage($request, $maxWidth, $maxHeight, $store);
            $newImage = $category->image()->create($imageData);

            // Get the ID of the newly associated image
            $newImageId = $newImage->id;

            // Delete the old img
            $adminCropResizeImage->deleteOldImage($category);
        }

        return redirect()->route('admin.categories.edit', $category)->with('success', 'Category has been Updated');
    }

    public function destroy(Category $category)
    {
        if ($category->name === 'uncategorized')
            return redirect()->route('admin.categories.index')->with('danger', 'You can not delete uncategorized one');

        $category->deleted = 1;
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('danger', 'Category has been Dezactivated');
    }
}
