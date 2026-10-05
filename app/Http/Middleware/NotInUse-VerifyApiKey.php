<?php

namespace App\Http\Middleware;

use Closure;

/**
 * 
 * This middleware class is responsible for verifying the API key provided in the request headers.
 * If the 'X-API-KEY' header does not match the configured API key, it returns an unauthorized response.
 * Otherwise, it allows the request to proceed to the next middleware or controller.
 * if you want to implement this security in api then add this middleware in api middleware group in bootstrap/app.php
 */

// class VerifyApiKey
// {
//     public function handle($request, Closure $next)
//     {
//         if ($request->header('X-API-KEY') !== config('app.api_key')) {
//             return response()->json(['error' => 'Unauthorized'], 401);
//         }
//         return $next($request);
//     }
// }
