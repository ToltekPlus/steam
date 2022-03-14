<?php

use Core\Router;

$router = new Router();
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);

/*=== АВТОРИЗАЦИЯ, РЕГИСТРАЦИЯ, ВЫХОД ИЗ АККАУНТА ===*/
$router->add('auth', ['controller' => 'LoginController', 'action' => 'auth']);
$router->add('logout', ['controller' => 'LoginController', 'action' => 'logout']);
$router->add('get_auth', ['controller' => 'LoginController', 'action' => 'getAuthId']);

/*=== РАБОТА С ИГРАМИ ===*/
$router->add('games/list', ['controller' => 'GameController', 'action' => 'index']);
$router->add('games/add', ['controller' => 'GameController', 'action' => 'show']);
$router->add('games/store', ['controller' => 'GameController', 'action' => 'store']);
$router->add('games/edit?{id}', ['controller' => 'GameController', 'action' => 'edit']);
$router->add('games/update', ['controller' => 'GameController', 'action' => 'update']);
$router->add('games/visibility?{id}', ['controller' => 'GameController', 'action' => 'visibility']);

/*=== РАБОТА С КОРЗИНОЙ ===*/
$router->add('cart/brief', ['controller' => 'CartController', 'action' => 'brief']);

/*=== УСТАНОВКА СКИДОК ===*/
$router->add('taxes/edit?{id}', ['controller' => 'GameTaxController', 'action' => 'create']);
$router->add('taxes/update', ['controller' => 'GameTaxController', 'action' => 'update']);

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

/*=== РАБОТА С КОРЗИНОЙ ===*/
$router->add('basket', ['controller' => 'BasketController', 'action' => 'index']);
$router->add('getProducts', ['controller' => 'BasketController', 'action' => 'getProducts']);

/*=== РАБОТА С ПСЕВДОСЫЛКАМИ ===*/
$router->add('symlinks', ['controller' => 'SymlinkController', 'action' => 'generate']);

/*=== ЛОГГИРОВАНИЕ ОШИБОК ===*/
$router->add('logs', ['controller' => 'LoggerController', 'action' => 'index']);

$router->dispatch($_SERVER['QUERY_STRING']);