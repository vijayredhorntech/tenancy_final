<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(Travelport::class, function ($app) {
            return new Travelport(config('services.travelport'));
        });

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        \Illuminate\Support\Facades\View::share('CURRENCY', config('app.currency'));
    }
}
