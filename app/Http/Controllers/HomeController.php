<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(20);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
