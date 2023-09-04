<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class PreprodAccess
{
    public function __construct(Request $request)
    {    
        if (env('APP_ENV') === 'preprod') 
        {
            $clientIP = $request->ip();   
            if ($clientIP !== '83.103.225.235')
                abort(403, 'Access Denied | Unauthorized');
        }
    }
}
