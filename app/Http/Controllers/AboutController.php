<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\Post;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {
        $seo = Seo::where('page_name', '=', 'About')->first();
        
        return view('about', [
            'seo' => $seo,
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