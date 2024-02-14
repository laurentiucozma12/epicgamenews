<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostSearchService;

class PrivacyPolicyController extends Controller
{
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function index()
    {
        return view('privacy_policy');
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}
