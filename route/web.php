<?php

use Core\Router;

$router = new Router();
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);

/*=== АВТОРИЗАЦИЯ, РЕГИСТРАЦИЯ, ВЫХОД ИЗ АККАУНТА ===*/
$router->add('auth', ['controller' => 'LoginController', 'action' => 'auth']);
$router->add('logout', ['controller' => 'LoginController', 'action' => 'logout']);

/*=== РАБОТА С РОЛЯМИ ===*/
$router->add('roles', ['controller' => 'UserRoleController', 'action' => 'index']);
$router->add('roles/role?{id}', ['controller' => 'UserRoleController', 'action' => 'get']);

/*=== РАБОТА С КОМПАНИЯМИ ===*/
$router->add('companies', ['controller' => 'CompanyController', 'action' => 'index']);
$router->add('companies/add', ['controller' => 'CompanyController', 'action' => 'show']);
$router->add('companies/store', ['controller' => 'CompanyController', 'action' => 'store']);
$router->add('companies/edit?{id}', ['controller' => 'CompanyController', 'action' => 'get']);

/*=== РАБОТА С ЖАНРАМИ ===*/
$router->add('genres', ['controller' => 'GenreController', 'action' => 'index']);
$router->add('genres/add', ['controller' => 'GenreController', 'action' => 'show']);
$router->add('genres/store', ['controller' => 'GenreController', 'action' => 'store']);

$router->dispatch($_SERVER['QUERY_STRING']);