<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Platform;
use App\Models\More;
use Closure;
use Illuminate\Support\Facades\View;

class NavbarServices
{
    public function handle($request, Closure $next)
    {
        $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
        $platforms = Platform::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();
        $mores = More::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();

        View::share('navbar_categories', $categories);
        View::share('navbar_platforms', $platforms);
        View::share('navbar_mores', $mores);

        return $next($request);
    }
}
