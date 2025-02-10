<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Jenssegers\Date\Date;

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
//        Date::setLocale(config('app.locale')); // Définit la langue en fonction de la config Laravel

    }
}
