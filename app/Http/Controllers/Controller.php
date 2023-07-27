<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Category;
use App\Models\Platform;
use App\Models\More;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function loadNavbarData()
    {
        $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
        $platforms = Platform::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();
        $mores = More::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();

        View::share('navbar_categories', $categories);
        View::share('navbar_platforms', $platforms);
        View::share('navbar_mores', $mores);
    }
}
