<?php

namespace App\Providers;

use App\Repository\CategoryRepositiry\CategoryRepositoryInterface;
use App\Repository\CategoryRepositiry\ElequentsCategoryRepository;
use App\Repository\ReportRepository\ElequentReportRepository;
use App\Repository\ReportRepository\ReportRepositoryInterface;
use App\Repository\TaskRepository\ElequentTaskRepository;
use App\Repository\TaskRepository\TaskRepositoryInterface;
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

    }
}
