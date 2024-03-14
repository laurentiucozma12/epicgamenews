<?php

namespace App\Services;

use App\Models\Post;

class PostSearchService
{
    public function search($search)
    {
        return Post::where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('excerpt', 'like', "%$search%")
                ->orWhere('body', 'like', "%$search%")
                ->orWhereHas('video_game', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhereHas('categories', function ($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        })
                        ->orWhereHas('platforms', function ($query) use ($search) {
                            $query->where('name', 'like', "%$search%");
                        });
                });
        })
        ->latest()
        ->where('deleted', 0)
        ->paginate(20);
    }
}