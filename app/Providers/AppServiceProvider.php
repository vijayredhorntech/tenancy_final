<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VisaRepository;
use App\Repositories\Interfaces\VisaRepositoryInterface;

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
    }
}
