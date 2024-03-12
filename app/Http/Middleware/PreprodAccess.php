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
        $clientIP = $request->ip();
        dd( $clientIP);
        // if ($currentBranch === 'pre-production') 
        // {
        //     $clientIP = $request->ip();
            
        //     Log::channel('custom_testing')->info('image_saving_name', [$clientIP]);
            
        //     $allowedIPs = [
        //         '83.103.225.235', // home ip
        //         '86.124.113.212', '101.188.67.134', '86.124.118.32', // mobile hotspot
        //         '127.0.0.1', // localhost
        //     ];
            
        //     // Get the client's IP address (you may need to adjust this based on your application)
        //     $clientIP = $_SERVER['REMOTE_ADDR'];
            
        //     // Check if the client's IP is in the allowed list
        //     if (in_array($clientIP, $allowedIPs)) {
        //         // IP is allowed, continue with the request
        //         return $next($request);
        //     }
        //     else {
        //         abort(403, 'Access Denied | Unauthorized');
        //     }
        // }

        return $next($request);
    }
}
