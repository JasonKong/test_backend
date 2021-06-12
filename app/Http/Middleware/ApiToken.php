<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $auth = JWTAuth::parseToken()->authenticate();
            if (!$auth) {
                return response()->json('Unauthorized', 401);
            }
        } catch (\Exception $e) {
            return response()->json('Unauthorized:'.$e->getMessage(), 401);
        }

        return $next($request);
    }
}
