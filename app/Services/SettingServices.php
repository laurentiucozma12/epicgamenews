<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Schema;

use App\Models\Setting;

class SettingServices
{
    public function handle($request, Closure $next)
    {
        
        if ( Schema::hasTable('settings') )
        {
            $setting = Setting::find(1);
            View::share('setting', $setting);
        }

        return $next($request);
    }
}
