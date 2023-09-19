<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;
use App\Models\VideoGame;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::excludeUncategorized()
            ->latest()
            ->approved()
            ->withCount('comments')
            ->paginate(10);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
