<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\About;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        if( Schema::hasTable('categories') ) {
            
            $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
            View::share('navbar_categories', $categories);

            $about = About::find(1);
            View::share('about', $about);
        }
    }
}