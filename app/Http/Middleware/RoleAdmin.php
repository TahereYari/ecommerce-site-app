<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role != 'user') {
            return $next($request);
        }
        // else{
        //     abort(404,'شما دسترسی لازم برای ورود به این صفحه رو ندارید');
        // }

        return redirect()->route('login');
    }
}
