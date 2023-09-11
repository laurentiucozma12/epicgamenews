<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Schema;

use App\Models\About;

class AboutServices
{
    public function handle($request, Closure $next)
    {
        
        if ( Schema::hasTable('abouts') )
        {
            $about = About::find(1);
            View::share('about', $about);
        }

        return $next($request);
    }
}
