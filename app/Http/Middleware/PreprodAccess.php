<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PreprodAccess
{
    public function handle(Request $request, Closure $next): Response
    {    
        $currentBranch = trim(shell_exec('git rev-parse --abbrev-ref HEAD'));
        if ($currentBranch === 'pre-production') 
        {
            $clientIP = $request->ip();
            Log::channel('custom_testing')->info('image_saving_name', [$clientIP]);
            Log::channel('custom_testing')->info('image_saving_name', ['///////////////////////////////////////////////']);
            // home ip
            if ($clientIP === '83.103.225.235'
            // mobile hotspot
            || $clientIP === '5.14.142.80'
            || $clientIP === '5.14.136.80'
            // localhost
            || $clientIP === '127.0.0.1')
            {
                return $next($request);
            }    
            else {
                abort(403, 'Access Denied | Unauthorized');
            }
        }

        return $next($request);
    }
}
