<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostSearchService;

class AboutController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function __invoke(Request $request)
    {
        $seo = Seo::where('page_name', 'About')
            ->where('page_type', 'main')
            ->first();

        return view('about', [
            'seo' => $seo,
        ]);
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}