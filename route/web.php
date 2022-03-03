<?php

use Core\Router;

$router = new Router();
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);

/*=== АВТОРИЗАЦИЯ, РЕГИСТРАЦИЯ, ВЫХОД ИЗ АККАУНТА ===*/
$router->add('auth', ['controller' => 'LoginController', 'action' => 'auth']);
$router->add('logout', ['controller' => 'LoginController', 'action' => 'logout']);
$router->add('get_auth', ['controller' => 'LoginController', 'action' => 'getAuthId']);

/*=== РАБОТА С РОЛЯМИ ===*/
$router->add('roles/list', ['controller' => 'UserRoleController', 'action' => 'index']);
$router->add('roles/role?{id}', ['controller' => 'UserRoleController', 'action' => 'show']);

/*=== РАБОТА С КОМПАНИЯМИ ===*/
$router->add('companies/list', ['controller' => 'CompanyController', 'action' => 'index']);
$router->add('companies/add', ['controller' => 'CompanyController', 'action' => 'show']);
$router->add('companies/store', ['controller' => 'CompanyController', 'action' => 'store']);
$router->add('companies/edit?{id}', ['controller' => 'CompanyController', 'action' => 'edit']);
$router->add('companies/update', ['controller' => 'CompanyController', 'action' => 'update']);
$router->add('companies/delete', ['controller' => 'CompanyController', 'action' => 'delete']);

/*=== РАБОТА С ЖАНРАМИ ===*/
$router->add('genres/list', ['controller' => 'GenreController', 'action' => 'index']);
$router->add('genres/add', ['controller' => 'GenreController', 'action' => 'show']);
$router->add('genres/store', ['controller' => 'GenreController', 'action' => 'store']);
$router->add('genres/edit?{id}', ['controller' => 'GenreController', 'action' => 'edit']);
$router->add('genres/update', ['controller' => 'GenreController', 'action' => 'update']);
$router->add('genres/delete', ['controller' => 'GenreController', 'action' => 'delete']);

/*=== РАБОТА С ПСЕВДОСЫЛКАМИ ===*/
$router->add('symlinks', ['controller' => 'SymlinkController', 'action' => 'generate']);

/*=== РАБОТА С БАЛАНСОМ ===*/
$router->add('balances/list', ['controller' => 'BalanceController', 'action' => 'index']);
$router->add('balances/store', ['controller' => 'BalanceController', 'action' => 'store']);

$router->dispatch($_SERVER['QUERY_STRING']);
