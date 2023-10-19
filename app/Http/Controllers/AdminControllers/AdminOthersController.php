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
            $adminCropResizeImage = new AdminCropResizeImage();
            $store = 'others';
            $maxWidth = 720;
            $maxHeight = 405;
            $imageData = $adminCropResizeImage->cropResizeImage($request, $maxWidth, $maxHeight, $store);
            $other->image()->create($imageData);
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
        $updateRules['thumbnail'] = 'nullable|image|max:1920';
        $this->rules['slug'] = ['required', Rule::unique('others')->ignore($other)];
        $validated = $request->validate($this->rules);
        $other->update($validated);
        
        if ($request->hasFile('thumbnail')) {
            $store = 'others';
            $maxWidth = 720;
            $maxHeight = 405;
            
            // Upload and save the new image
            $adminCropResizeImage = new AdminCropResizeImage();
            $imageData = $adminCropResizeImage->cropResizeImage($request, $maxWidth, $maxHeight, $store);
            $other->image()->update($imageData);          
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