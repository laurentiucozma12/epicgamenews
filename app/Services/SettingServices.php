<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\View;

use App\Models\Setting;

class SettingServices
{
    public function handle($request, Closure $next)
    {
        $setting = Setting::find(1);
        View::share('setting', $setting);

        return $next($request);
    }
}
