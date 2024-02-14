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

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where(function($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('excerpt', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%");
        })
        ->orWhereHas('video_game', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('video_game.categories', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->orWhereHas('video_game.platforms', function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->latest()
        ->where('deleted', 0)
        ->paginate(20);

        return view('home', compact('posts', 'search'));
    }
}