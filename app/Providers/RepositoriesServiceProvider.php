<?php

namespace App\Providers;

use App\Repository\CategoryRepositiry\CategoryRepositoryInterface;
use App\Repository\CategoryRepositiry\ElequentsCategoryRepository;
use App\Repository\MainGroupRepository\ElequentMainGroupRepository;
use App\Repository\MainGroupRepository\MainGroupRepositoryInterface;
use App\Repository\ReportRepository\ElequentReportRepository;
use App\Repository\ReportRepository\ReportRepositoryInterface;
use App\Repository\SubGroupRepository\ElequentSubGroupRepository;
use App\Repository\SubGroupRepository\SubGroupRepositoryInterface;
use App\Repository\TaskRepository\ElequentTaskRepository;
use App\Repository\TaskRepository\TaskRepositoryInterface;
use App\Repository\TypeRepository\ElequentTypeRepository;
use App\Repository\TypeRepository\TypeRepositoryInterface;
use App\Repository\UserRepository\ElequentsUserRepository;
use App\Repository\UserRepository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind(UserRepositoryInterface::class , ElequentsUserRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class , ElequentsCategoryRepository::class);

        $this->app->bind(TypeRepositoryInterface::class , ElequentTypeRepository::class);

        $this->app->bind(MainGroupRepositoryInterface::class , ElequentMainGroupRepository::class);

        $this->app->bind(SubGroupRepositoryInterface::class , ElequentSubGroupRepository::class);

    }
}
