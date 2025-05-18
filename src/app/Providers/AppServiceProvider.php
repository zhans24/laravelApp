<?php

namespace App\Providers;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Repositories\ReviewRepositoryInterface;
use App\Infrastructure\Repository\CategoryRepository;
use App\Infrastructure\Repository\ProductRepository;
use App\Infrastructure\Repository\ReviewRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
             ProductRepository::class
        );
        $this->app->bind(
            ReviewRepositoryInterface::class,
            ReviewRepository::class
        );
    }

    public function boot()
    {
        //
    }
}
