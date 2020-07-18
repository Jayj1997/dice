<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class VerifyEntry
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
        // 还没想好如何用更节省资源的方式保证安全性
        $header = $request->headers->get('verify_entry');
        $my_app_secret = env('MY_APP_SECRET');
        return $next($request);
    }
}
