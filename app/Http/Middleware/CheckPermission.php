<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next): Response
    {    
    if (auth()->user()->role->name === 'admin')
            return $next($request);
            
        // 1 - get route name
        $route_name = $request->route()->getName();
        // 2 - get permissions for this authenticated person
        $routes_arr = auth()->user()->role->permissions->toArray();
        // 3 - compare this route name with user permissions
        foreach ($routes_arr as $route) {            
            // 4 - if this route name is one of these permissions            
            if ($route['name'] === $route_name) {
                // 5 - allow user to acces
                return $next($request);
            }
        }

        abort(403, 'Access Denied | Unauthorized');
        // 6 - else abort 403  Unauthorized Access
    }
}
