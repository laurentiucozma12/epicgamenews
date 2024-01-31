<?php

namespace App\Http\Controllers;

use App\Models\Seo;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
}