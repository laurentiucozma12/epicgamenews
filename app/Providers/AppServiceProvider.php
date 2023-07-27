<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Platform;
use App\Models\More;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
        // $platforms = Platform::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();
        // $mores = More::withCount('posts')->orderBy('posts_count', 'DESC')->take(5)->get();

        // View::share('navbar_categories', $categories);
        // View::share('navbar_platforms', $platforms);
        // View::share('navbar_mores', $mores);
    }
}
