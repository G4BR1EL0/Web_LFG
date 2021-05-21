# Web_LFG

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

[![Run in Postman](Aqui las rutas)

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

- PHP
- Laravel
- Composer
- MySQL
- WorkBench
- Heroku
- Postman
- VSC

## Authors

- [Angel Rodriguez](linkedin.com/in/angel-rodriguez-2a9990207)
- [Gabriel Avarca](linkedin.com/in/gabriel-fullstack)
- [Isrrael Sanchez](https://www.linkedin.com/in/danny-isrrael-sanchez-ortiz-704785177/)

[TOP](#Table-of-contents)
