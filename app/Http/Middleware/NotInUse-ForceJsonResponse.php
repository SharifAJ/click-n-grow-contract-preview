<?php

namespace App\Http\Middleware;

use Closure;

class ForceJsonResponse
{
    public function handle($request, Closure $next)
    {
        // Force JSON response for all API requests
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}