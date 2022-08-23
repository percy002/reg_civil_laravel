<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // dd(Auth::check());
        if (! $request->expectsJson()) {
            return route('inicio');
        }

        // if (Auth::check()) {
        //     return $next($request);
        // } else {
        //     return view('application');
        // }
    }
}
