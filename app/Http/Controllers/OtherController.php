<?php

namespace App\Http\Controllers;

use App\Models\Tag;

use App\Models\Post;
use App\Models\Other;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OtherController extends Controller
{
    public function index()
    {
        $others = Other::withCount(['posts' => function ($query) {
            // Count only the posts that are NOT 'deleted' or 'uncategorized'
            $query->where('deleted', '=', 0)
                ->where('name', '!=', 'uncategorized');
        }])
        ->whereHas('posts', function ($query) {
            // Send only the posts where count is bigger than 0
            $query->where('deleted', '=', 0)
                ->where('name', '!=', 'uncategorized');
        })
        ->where('name', '!=', 'uncategorized')
        ->deleted()
        ->paginate(20);

        return view('others.index', [
            'others' => $others
        ]);
    }

    public function show(Other $other)
    {
        if ($other->name === 'uncategorized') {
            abort(404); }

        $posts = $other->posts()->excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(20);

        $recent_posts = Post::excludeUncategorized()
            ->latest()
            ->deleted()
            ->paginate(5);

        $recent_postsArray = $recent_posts->items();

        return view('others.show', [
            'other' => $other,
            'posts' => $posts,
            'recent_posts' => $recent_postsArray,
        ]);    
    }
    
    // Scope functions
    public function scopeDeleted($query)
    {
        return $query->where('deleted', 0); 
    }
}
