<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VisaRepository;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Repositories\ClintRepository;
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;
use App\Repositories\StaffRepository;
use App\Repositories\Interfaces\TeamManagementRepositoryInterface;
use App\Repositories\TeamManagementRepository;




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
        $this->app->bind(StaffRepositoryInterface::class, StaffRepository::class);
        $this->app->bind(TeamManagementRepositoryInterface::class, TeamManagementRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
