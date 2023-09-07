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
    
            $filteredCategories = $categories->reject(function ($categorie) {
                return $categorie->name === 'uncategorized';
            });
            
            $filteredPlatforms = $platforms->reject(function ($platform) {
                return $platform->name === 'uncategorized';
            });
            
            $filteredOthers = $others->reject(function ($other) {
                return $other->name === 'uncategorized';
            });

            View::share('navbar_categories', $filteredCategories);
            View::share('navbar_platforms', $filteredPlatforms);
            View::share('navbar_others', $filteredOthers);
        }
    
        return $next($request);
    }
}
