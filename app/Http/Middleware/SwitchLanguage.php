<?php

namespace App\Http\Middleware;

use Closure;

class SwitchLanguage
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
        app()->setLocale('en');
        if(isset($request->lang) && $request->lang=='ar'){
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
