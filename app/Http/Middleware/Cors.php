<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        return $next($request)
            ->header('Access-Control-Alow-Origin', '*')
            ->header('Access-Control-Alow-Credentials', true)
            ->header('Access-Control-Alow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Alow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');

    }
}
