<?php
namespace App\Providers;
use Domain\IRepository\ICategoryRepository;
use Domain\IRepository\IUserRepository;
use Domain\IRepository\IRoleRepository;
use Infrastructure\Persistence\Repository\RoleRepository;
use Infrastructure\Persistence\Repository\CategoryRepository;
use Domain\IRepository\ICategoryAttributeRepository;
use Infrastructure\Persistence\Repository\CategoryAttributeRepository;
use Application\Contracts\ProductServiceInterface;
use Application\Contracts\UserServiceInterface;
use Application\Services\ProductService;
use Application\Services\UserService;
use Domain\IRepository\IProductRepository;
use Infrastructure\Persistence\Repository\ProductRepository;
use Infrastructure\Persistence\Repository\UserRepository;
use Domain\IService\IProductValidationService;
use Application\Services\ProductValidationService;
use Domain\IService\IUserValidationService;
use Infrastructure\ServiceImplementations\UserValidationService;


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


    $this->app->bind(ProductServiceInterface::class, ProductService::class);
    $this->app->bind(UserServiceInterface::class, UserService::class);
    
    /*  |||| REPOSITORIS||||*/
    $this->app->bind(IRoleRepository::class, RoleRepository::class);
    $this->app->bind(IUserRepository::class, UserRepository::class);
    $this->app->bind(IProductRepository::class, ProductRepository::class);
    /*  |||| VALIDATION_ERR||||*/
    $this->app->bind(IProductValidationService::class, ProductValidationService::class);
    $this->app->bind(IUserValidationService::class, UserValidationService::class);
  }
  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
