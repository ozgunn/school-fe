<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (session('token')) {
            return $next($request);
        }

        return redirect('/login');
    }
}
