<?php

namespace App\Providers;

use App\Repository\OrderRepository\EloquentOrderRepository;
use App\Repository\OrderRepository\OrderRepositoryInterface;
use App\Repository\CategoryRepositiry\CategoryRepositoryInterface;
use App\Repository\CategoryRepositiry\ElequentsCategoryRepository;
use App\Repository\MainGroupRepository\ElequentMainGroupRepository;
use App\Repository\MainGroupRepository\MainGroupRepositoryInterface;
use App\Repository\MenuRepository\EloquentMenuRepository;
use App\Repository\MenuRepository\MenuRepositoryInterface;
use App\Repository\MenuRepository\WatingToBuildMenuJsonRepositoryInterface;
use App\Repository\ProductRepository\ElequentProductRepository;
use App\Repository\ProductRepository\ProductRepositoryInterface;
use App\Repository\ReportRepository\ElequentReportRepository;
use App\Repository\ReportRepository\ReportRepositoryInterface;
use App\Repository\RestrauntRepository\EloquentRestrauntRepository;
use App\Repository\RestrauntRepository\RestrauntRepositoryInterface;
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

        $this->app->bind(ProductRepositoryInterface::class , ElequentProductRepository::class);

        $this->app->bind(RestrauntRepositoryInterface::class , EloquentRestrauntRepository::class);

        $this->app->bind(MenuRepositoryInterface::class , EloquentMenuRepository::class);

        $this->app->bind(WatingToBuildMenuJsonRepositoryInterface::class , EloquentMenuRepository::class);

        $this->app->bind(OrderRepositoryInterface::class , EloquentOrderRepository::class);


    }
}
