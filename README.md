
_Management of an Online Gaming Application, managed through a SQL database and that interacts with functions developed in PHP with the Laravel ORM to manage SQL functions._

## Table of contents
- [INTRODUCTION](#INTRODUCTION)
- [Run](#Run)
- [Authentication](#Authentication)
- [Authorization](#Authorization)
- [Routes](#Routes)
    - [Users](#Users)
- [Folder structure](#Project-folder-structure)
- [Technologies](#Technologies)
- [Authors](#Authors)

## INTRODUCTION: 🔧

- Backend: Download and install PHP.
- Data Base: Download and install MySQL, write the database name on the ***ApiLaravel*** environmental variable in ***.env*** file at the project root, by default this value is a **Web_LFG**.
- Port: Set ***port*** variable in the environmental variable  file ***.env*** by default this value is 8000.
- Install Composer.
- Install Laravel.
- Install Postman.

## Run 🚀

- Initialize the corresponding database manager, whose database name will be ApiLaravel.
- After downloading and opening the project "WEB_LFG", it will be ready to carry out the migrations with the following command:

    php artisan migrate

Then we will proceed to initialize the server using the command:

    php artisan serve


## Authentication

New users will have to signup in order to access the service.
Registered users can login and once the user is logged in, each subsequent request must include a **Token**, which allows the user to access routes, services, and resources that are permitted with that token.

## Authorization

All new users are created with ‘user’ role by default, only the ‘admin’ role user can create and delete partys.

## Routes

The supported request body format is JSON.
All routes but the login, logout and signup require authentication by TOKEN sent on the request via headers.

headers:
authentication: {token}.

## Users

The user request data need to be sent through headers:
- **POST** /auth/register
        {
                “name”: “username”,
                “email”: “user@example.com”,
                “password”: “1234”
        }

- **POST** /auth/login
        {
                “email”: “user@example.com”,
                “password”: “1234”
        }

[![Run in Postman]()

## Folder structure

    ├───app
        ├───Http
            ├───Controllers
                ├───AuthController.php
                ├───BanController.php
                ├───ChatController.php
                ├───Controller.php
                ├───GameController.php
                ├───PartyController.php
                ├───PartyUsersController.php
                └───UserController.php
            ├───Middleware
            └───Kernel.php
        ├───Models
            ├───Ban.php
            ├───Chat.php
            ├───Game.php
            ├───Party.php
            ├───PartyUser.php
            └───User.php
    ├───database
        ├───factories
        ├───migrations
        └───seeders
    ├───routes
        ├───api.php
        └───web.php

## Technologies

## Authors

[TOP](#Table-of-contents)
------------------------------------------------------------------------------------------------------------

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
