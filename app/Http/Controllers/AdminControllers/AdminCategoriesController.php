<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Category;

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
            $adminCropResizeImage = new AdminCropResizeImage();
            $store = 'categories';
            $maxWidth = 720;
            $maxHeight = 405;
            $imageData = $adminCropResizeImage->cropResizeImage($request, $maxWidth, $maxHeight, $store);
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
        $category->update($validated);

        if ($request->hasFile('thumbnail')) {
            $store = 'categories';
            $maxWidth = 720;
            $maxHeight = 405;
            
            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->cropResizeImage($request, $maxWidth, $maxHeight, $store);
            $category->image()->update($imageData);          
        }

        return redirect()->route('admin.categories.edit', $category)->with('success', 'Category has been Updated');
    }

    public function destroy(Category $category)
    {
        $default_category_id = Category::where('name', 'uncategorized')->first()->id;

        if ($category->name === 'uncategorized')
            abort('404');

        $category->posts()->update(['category_id' => $default_category_id]);

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category has been Deleted');
    }
}
