<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSeoController extends Controller
{
    private $rules = [
        'title' => 'required|min:2|max:250',
        'description' => 'required|min:5|max:300',
        'keywords' => 'required|max:255',
    ];
    
    public function index() {
        // Dynamic SEO for main pages home/video-games/categories/plaforms/about/contact
        $main_pages = Seo::where(strtolower('page_type'), 'main')->get();

        return view('admin_dashboard.seo.index', [
            'seos' => $main_pages,   
        ]);
    }

    public function edit(Seo $seo) {        
        $page_name = strtolower($seo->page_name);
        $restrictedPages = ['privacy', 'login', 'register'];

        if (in_array($page_name, $restrictedPages)) {
            return redirect()->back()->with('danger', "You cannot update $seo->page_name!");
        }
        
        return view('admin_dashboard.seo.edit', [
            'seo' => $seo,
        ]);
    }

    public function update(Request $request, Seo $seo) {
        $description = strtolower($request->input('description'));
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $keywords = $validated['keywords'] = strtolower($validated['keywords']);
        
        $seo->update($validated);
        
        $seo->update([
            'title' => $request->input('title'),
            'description' => $description,
            'keywords' => $keywords,
        ]);

        return redirect()->route('admin.seo.edit', $seo)->with('success', 'SEO ' . $seo->page_name . ' updated successfully');
    }
}
