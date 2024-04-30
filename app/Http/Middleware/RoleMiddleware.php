<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            foreach ($roles as $role) {
                if (Auth::user()->role == $role) {
                    return $next($request);
                }
            }
        }

        return response('Unauthorized.', 401);
    }


   
}
