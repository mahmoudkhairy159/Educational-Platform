<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->api_password!=env('api_password','toto2212')){
            return response()->json([
                'error' => [
                    'code' => 401,
                   'message' => 'Unauthorized',
                ]
            ], 401);
        }
        return $next($request);
    }
}
