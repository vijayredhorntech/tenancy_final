<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VisaRepository;
use App\Repositories\Interfaces\VisaRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(VisaRepositoryInterface::class, VisaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
