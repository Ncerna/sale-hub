<?php

namespace App\Providers;
use Domain\IRepository\ICategoryRepository;
use Infrastructure\Persistence\CategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;
use Infrastructure\Persistence\CategoryAttributeRepository;
use Application\Contracts\ProductServiceInterface;
use Application\Services\ProductApplicationService;
use Domain\IRepository\IProductRepository;
use Infrastructure\Persistence\Repository\ProductRepository;

use Domain\IService\IProductValidationService;
use Application\Services\ProductValidationService;


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
