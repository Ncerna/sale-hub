<?php

namespace App\Providers;
use App\Domain\IRepository\ICategoryRepository;
use App\Infrastructure\Persistence\CategoryRepository;
use App\Domain\IRepository\ICategoryAttributeRepository;
use App\Infrastructure\Persistence\CategoryAttributeRepository;
use App\Application\Contracts\ProductServiceInterface;
use App\Application\Services\ProductApplicationService;
use App\Domain\IRepository\IProductRepository;
use App\Infrastructure\Persistence\Repository\ProductRepository;

use App\Domain\IService\IProductValidationService;
use App\Application\Services\ProductValidationService;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(ICategoryAttributeRepository::class, CategoryAttributeRepository::class);

    // ya tenías este para categorías:
    $this->app->bind(ICategoryRepository::class, CategoryRepository::class);


     $this->app->bind(ProductServiceInterface::class, ProductApplicationService::class);
 
     $this->app->bind(IProductRepository::class, ProductRepository::class);
     $this->app->bind(IProductValidationService::class, ProductValidationService::class);
  }
  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
