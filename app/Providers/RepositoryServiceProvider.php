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
use App\Repositories\Interfaces\DocumentSignRepositoryInterface;
use App\Repositories\DocumentSignRepository;
use App\Repositories\Interfaces\TermConditionRepositoryInterface;
use App\Repositories\TermConditionRepository;
use App\Repositories\Interfaces\SPStaffRepositoryInterface;
use App\Repositories\SPStaffRepository;



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
        $this->app->bind(DocumentSignRepositoryInterface::class, DocumentSignRepository::class);
        $this->app->bind(TermConditionRepositoryInterface::class, TermConditionRepository::class);
        $this->app->bind(SPStaffRepositoryInterface::class, SPStaffRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
