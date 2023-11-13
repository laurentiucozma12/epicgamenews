<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if $role not empty & different than 'user' & $deleted active, give acces to admin panel
        if (auth()->user()->roles->isNotEmpty() 
        && !auth()->user()->roles->contains('name', 'user')
        && auth()->user()->deleted === 0) {

            // Testing
            dd( auth()->user()->roles->isNotEmpty(), auth()->user()->roles->contains('name', 'user'), auth()->user()->deleted);
            
            // Get the route name
            $route_name = $request->route()->getName();
            // Get permissions for this authenticated person
            $userPermissions = [];
            foreach (auth()->user()->roles as $role) {
                foreach ($role->permissions as $permission) {
                    $userPermissions[] = $permission->name;
                }
            }
    
            // Compare this route name with user permissions
            if (in_array($route_name, $userPermissions)) {
                return $next($request);
            }
        }
        // Access Denied
        abort(403, 'Access Denied | Unauthorized');
    }
}
