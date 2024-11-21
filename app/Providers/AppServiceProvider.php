<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // خواندن زبان از کوکی
        $locale = Cookie::get('AdminLanguage', config('app.locale'));

        // تنظیم زبان اپلیکیشن
        App::setLocale($locale);

        Paginator::useBootstrap();
    }
}
