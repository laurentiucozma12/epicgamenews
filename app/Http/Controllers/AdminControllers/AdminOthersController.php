<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Other;

class AdminOthersController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|max:30',
        'slug' => 'required|unique:others,slug',
        'thumbnail' => 'required|image|max:1920',
    ];

    public function index()
    {
        $others = Other::with('user')->orderBy('id', 'DESC')->paginate(100);
        
        return view('admin_dashboard.others.index', [
            'others' => $others
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.others.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $other = Other::create($validated);

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
            $other->image()->create($image_data);
        }

        return redirect()->route('admin.others.create')->with('success', 'Other has been Created');
    }

    public function show(Other $other)
    {
        $posts = $other->posts()->latest()->paginate(100);
        
        return view('admin_dashboard.others.show', [
            'other' => $other,
            'posts' => $posts,
        ]);
    }

    public function edit(Other $other)
    {
        return view('admin_dashboard.others.edit', [
            'other' => $other
        ]);
    }

    public function update(Request $request, Other $other)
    {
        $this->rules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('others')->ignore($other)];
        $validated = $request->validate($this->rules);
        $other->update($validated);
        
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
            $newImage = $other->image()->create($imageData);

            // Get the ID of the newly associated image
            $newImageId = $newImage->id;

            $folders = [
                'images/764x431',
                'images/342x192',
                'images/400x225',
                'images/300x169',                  
            ];
            
            $adminCropResizeImage->deleteOldImages($other, $folders);
        }

        return redirect()->route('admin.others.edit', $other)->with('success', 'Other has been Updated');
    }

    public function destroy(Other $other)
    {
        if ($other->name === 'uncategorized')
            return redirect()->route('admin.others.index')->with('danger', 'You can not delete uncategorized one');

        $other->deleted = 1;
        $other->save();
        
        return redirect()->route('admin.others.index')->with('danger', 'Other has been Dezactivated');
    }
}