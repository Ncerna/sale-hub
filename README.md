<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

La arquitectura mostrada corresponde a una Arquitectura Hexagonal o también conocida como Arquitectura de Puertos y Adaptadores combinada con principios de Arquitectura en Capas y conceptos de Domain-Driven Design (DDD).

sale-hub/
├── App/                                      # Código de arranque de la aplicación (opcional según framework)
├── config/                                   # Configuraciones (database, app, servicios, etc.)
├── public/                                   # Punto de entrada web (index.php, assets públicos)
├── routes/                                   # Definición de rutas (web.php, api.php, etc.)
├── storage/                                  # Archivos temporales, logs, caché, etc.
├── tests/                                    # Pruebas unitarias y funcionales
├── vendor/                                   # Librerías instaladas por Composer
├── .env                                      # Variables de entorno (no subir al repositorio)
├── composer.json                             # Archivo de dependencias del proyecto
├── src/                                      # Código fuente principal del proyecto
│
│   ├── Domain/                               # Capa de dominio (lógica de negocio)
│   │   ├── Entity/                           # Entidades del dominio (Sale.php, User.php, etc.)
│   │   ├── ValueObject/                      # Objetos de valor (ID, Email, etc.)
│   │   ├── IRepository/                      # Interfaces de repositorios
│   │   └── IService/                         # Interfaces de servicios de dominio
│
│   ├── Application/                          # Capa de aplicación (coordinación de casos de uso)
│   │   ├── UseCase/                          # Casos de uso de negocio
│   │   ├── Service/                          # Servicios de aplicación (interactúan con dominio)
│   │   ├── DTO/                              # Objetos de transferencia de datos
│   │   └── Command/                          # Comandos o solicitudes específicas (opcional)
│
│   └── Infrastructure/                       # Capa de infraestructura
│       ├── Persistence/                      # Persistencia de datos
│       │   ├── Eloquent/                     # Implementación con Eloquent ORM
│       │   ├── Doctrine/                     # Implementación con Doctrine ORM
│       │   ├── OtherORM/                     # Otros ORM o motores de persistencia
│       │   └── Repository/                   # Repositorios concretos que implementan IRepository
│       │
│       ├── ApiClients/                       # Clientes para consumir APIs externas
│       ├── ServiceImplementations/           # Implementaciones concretas de servicios
│       ├── Connections/                      # Conexiones a bases de datos, colas, etc.
│       └── Framework/                        # Adaptadores específicos del framework
│           ├── Controller/                   # Controladores HTTP
│           ├── Middleware/                   # Middlewares
│           ├── Adapters/                     # Adaptadores (ej: para mensajería, colas)
│           └── Factories/                    # Fábricas de clases o servicios


## Learning Laravel

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
