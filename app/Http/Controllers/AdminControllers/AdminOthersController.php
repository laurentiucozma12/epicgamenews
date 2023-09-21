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
        'thumbnail' => 'required|image|dimensions:max_width=1920,max_height=1080',
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
        
        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('others', 'public');
    
            $other->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
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
        $this->rules['thumbnail'] = 'nullable|image|dimensions:max_width=1920,max_height=1080';
        $this->rules['slug'] = ['required', Rule::unique('others')->ignore($other)];
        $validated = $request->validate($this->rules);
        $other->update($validated);
        
        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('others', 'public');

            $other->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        return redirect()->route('admin.others.edit', $other)->with('success', 'Video Game has been Updated');
    }

    public function destroy(Other $other)
    {
        $default_other_id = Other::where('name', 'uncategorized')->first()->id;

        if ($other->name === 'uncategorized')
            abort('404');

        $other->posts()->update(['other_id' => $default_other_id]);

        $other->delete();
        return redirect()->route('admin.others.index')->with('success', 'Video Game has been Deleted');
    }
}