<?php

namespace App\Services;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Schema;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;

use Closure;

class NavbarServices
{
    public function handle($request, Closure $next)
    {    
        if (Schema::hasTable('categories') && Schema::hasTable('platforms') && Schema::hasTable('others'))
        {
            $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
            $platforms = Platform::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();
            $others = Other::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();
    
            View::share('navbar_categories', $categories);
            View::share('navbar_platforms', $platforms);
            View::share('navbar_others', $others);
        }
    
        return $next($request);
    }
}
