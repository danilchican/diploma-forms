<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class RoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @param array                     $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (\Auth::guest()) {
            return redirect()->route('login');
        }

        if (!$request->user()->hasRole($role)) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
