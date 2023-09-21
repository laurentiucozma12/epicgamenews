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
        'thumbnail' => 'required|image|dimensions:max_width=1920,max_height=1080',
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
        
        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('platforms', 'public');
    
            $platform->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
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
        $this->rules['thumbnail'] = 'nullable|image|dimensions:max_width=1920,max_height=1080';
        $this->rules['slug'] = ['required', Rule::unique('platforms')->ignore($platform)];
        $validated = $request->validate($this->rules);
        $platform->update($validated);
        
        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $platform->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        return redirect()->route('admin.platforms.edit', $platform)->with('success', 'Video Game has been Updated');
    }

    public function destroy(Platform $platform)
    {
        $default_category_id = Platform::where('name', 'uncategorized')->first()->id;

        if ($platform->name === 'uncategorized')
            abort('404');

        $platform->posts()->update(['category_id' => $default_category_id]);

        $platform->delete();
        return redirect()->route('admin.platforms.index')->with('success', 'Video Game has been Deleted');
    }
}
