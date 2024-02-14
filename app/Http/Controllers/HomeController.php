<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostSearchService;

class HomeController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function index()
    {

        $seo = Seo::where('page_name', '=', 'Home')->first();

        $posts = Post::latest()
            ->where('deleted', 0)
            ->paginate(20);

        return view('home', [
            'seo' => $seo,
            'posts' => $posts,
        ]);
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}