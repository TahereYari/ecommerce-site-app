<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetAdminLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Cookie::get('AdminLanguage', config('app.locale'));
       
      
        // Log::info('Locale from cookie: ' . $locale);
        

        if ($locale) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
