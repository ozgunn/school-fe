<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    public function handle($request, Closure $next)
    {
        if (!session('locale')) {
            session(['locale' => config('app.locale')]);
        }

        App::setLocale(session('locale'));

        return $next($request);
    }
}
