<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSeoController extends Controller
{
    private $rules = [
        'title' => 'required|min:5|max:100',
        'description' => 'required|min:5|max:300',
        'keywords' => 'required|min:5|max:255',
    ];

    public function indexSeoPage() {
        return view('admin_dashboard.seo.index_page', [
            'seos' => Seo::all(),   
        ]);
    }

    public function editSeoPage(Seo $seo) {
        return view('admin_dashboard.seo.edit_page', [
            'seo' => $seo,
        ]);
    }

    public function updateSeoPage(Request $request, Seo $seo) {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $keywords = $validated['keywords'] = strtolower($validated['keywords']);
        
        $seo->update($validated);
        
        $seo->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'keywords' => $keywords,
        ]);

        return redirect()->route('admin.seo.edit_page', $seo)->with('success', 'SEO ' . $seo->page_name . ' updated successfully');
    }

    public function indexPost() {
        return view('admin_dashboard.seo.index_posts');
    }
}
