<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecretaryMiddleware
{   public function handle(Request $request, Closure $next)
    {
     
        if (  auth('sanctum')->user() &&  auth('sanctum')->user()->role == 'secretary') {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
