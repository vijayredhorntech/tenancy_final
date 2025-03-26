<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VisaRepository;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Repositories\ClintRepository;
use App\Repositories\Interfaces\ClintRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(VisaRepositoryInterface::class, VisaRepository::class);
        $this->app->bind(ClintRepositoryInterface::class, ClintRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
