<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

La arquitectura mostrada corresponde a una Arquitectura Hexagonal o también conocida como Arquitectura de Puertos y Adaptadores combinada con principios de Arquitectura en Capas y conceptos de Domain-Driven Design (DDD).



![alt text][https://uml.planttext.com/plantuml/png/bLLBJkGm4Dstb3kKsB220sI1YD83YiGqhK2phtOgO73Yo7P0Q8PJp57c25nid4_dqua3awNhLVczgdhEfJQeJ9a9RtKA8MPxZfdKG084lilI04B25J76F__ca12WKdoFy8IC8-0UdwMt4fGQC18KVtmo3TvmcNkhgkZwzcUqYMwzLO7i1Hy9JjOoGvwVm2zl1VRZkI6L8YE8jaec9JCn5L9p8zMx2_60WYTONN97wfKpgkwge4oWrj2YPeu2Oop_qj0uLbVe3wBhXnZDyL6GfbPOVMie4nlzQ1G6svie3CBeyyzce38e2i5PZUwaTi5GvaOXCxeBZNMsR5jnqU6yWNuSn7RbMjousbXtpwRhs07eXC3v-U-B_-MoqnIYfXageIBRrBPS2pl6x8haIyoQ17s5kIQp3BZXUeBeCNDKuUpimhcYtqgQsTfH3qyX9c6D9NFIpJBag2lJ3KRJ8DqZg-vpDtevpztyvJptG9Rp74DQJfeRN6l4Q7CL1p_kxkDTUB-BWu4PepnLg8soIQMYgH-l56Rq9jMBxzVMb4AGShkfnqnSr8TgjWxpW6_d-snV4-soqPQKjaefP-Jx_RQvESrjv2JKEDgrn5CMWxu42HQM_T8Rqo2EQaqv3FhIfjXsb9fqEyXBofFwZ_GF]
## Learning Laravel

Es un Diagrama de Clases UML con paquetes agrupados por capa

@startuml
' Cambiamos el layout a dirección de arriba hacia abajo
left to right direction

' DOMINIO
package "Domain" {
    interface IProductRepository
    interface IProductValidationService

    class Product
    class ProductAttribute
    class Price
    class IGVRate
    class IGVAffectationCode
}

' APLICACIÓN
package "Application" {
    package "Contracts" {
        interface ProductServiceInterface
    }

    package "Services" {
        class ProductApplicationService
        ProductApplicationService ..|> ProductServiceInterface
    }

    package "UseCase" {
        class CreateProductUseCase
        class UpdateProductUseCase
        class DeleteProductUseCase
        class GetProductUseCase
        class ListProductUseCase

        CreateProductUseCase --> IProductRepository
        CreateProductUseCase --> IProductValidationService
    }

    ' Relaciones internas de Application
    ProductApplicationService --> CreateProductUseCase
    ProductApplicationService --> UpdateProductUseCase
    ProductApplicationService --> DeleteProductUseCase
    ProductApplicationService --> GetProductUseCase
    ProductApplicationService --> ListProductUseCase
}

' INFRAESTRUCTURA
package "Infrastructure" {
    package "Framework::Controller" {
        class ProductController
        ProductController --> ProductServiceInterface : injects
    }

    package "Persistence::Repository" {
        class ProductRepository
        ProductRepository ..|> IProductRepository
    }

    package "Framework::Adapters" {
        class ProductAdapter
    }

    ProductRepository --> ProductAdapter : uses
}

@enduml


Diagrama de Componentes UML (en PlantUML)

@startuml
skinparam componentStyle rectangle
left to right direction

package "Infrastructure" {
  [ProductController] --> [ProductServiceInterface]
  [ProductRepository] --> [ProductAdapter]
  [ProductRepository] ..> [IProductRepository] : implements
}

package "Application" {
  [ProductApplicationService] ..> [ProductServiceInterface] : implements
  [ProductApplicationService] --> [CreateProductUseCase]
  [ProductApplicationService] --> [UpdateProductUseCase]
  [CreateProductUseCase] --> [IProductRepository]
  [CreateProductUseCase] --> [IProductValidationService]
}

package "Domain" {
  [IProductRepository] <<interface>>
  [IProductValidationService] <<interface>>
  [Product]
  [Price]
  [IGVRate]
}
@enduml


Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


[def]: img.png