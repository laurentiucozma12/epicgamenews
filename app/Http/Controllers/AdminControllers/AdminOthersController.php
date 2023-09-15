<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Other;

class AdminOthersController extends Controller
{
    private $rules = [
        'name' => 'required|min:3|max:30',
        'slug' => 'required|unique:others,slug'
    ];
    
    public function index()
    {
        return view('admin_dashboard.others.index', [
            'others' => Other::with('user')->orderBy('id', 'DESC')->paginate(50)
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
        Other::create($validated);

        return redirect()->route('admin.others.create')->with('success', 'Other has been Created');
    }

    public function show(Other $other)
    {
        return view('admin_dashboard.others.show', [
            'other' => $other
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
        $this->rules['slug'] = ['required', Rule::unique('others')->ignore($other)];
        $validated = $request->validate($this->rules);
        $other->update($validated);

        return redirect()->route('admin.others.edit', $other)->with('success', 'Other has been Updated');
    }

    public function destroy(Other $other)
    {
        $default_other_id = Other::where('name', 'uncategorized')->first()->id;

        if ($other->name === 'uncategorized')
            abort('404');

        $other->posts()->update(['other_id' => $default_other_id]);

        $other->delete();
        return redirect()->route('admin.others.index')->with('success', 'Other has been Deleted');
    }
}