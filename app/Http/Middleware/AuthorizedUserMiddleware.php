<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizedUserMiddleware
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

        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('normal')) {
            return $next($request);
        }

        return redirect()->route('login')->with('failure_message', 'You are not authorized user!.');
    }
}
