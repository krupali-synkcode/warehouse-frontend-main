<?php

namespace App\Providers;

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
        Paginator::useBootstrap();
        
        // Initialize helper function file
        require_once app_path().'/Helpers/helpers.php';

        // set global variable to access in all blade files
        view()->composer('*', function ($view) {
            $view->with('getLocale', app()->getLocale());
        });
    }
}
