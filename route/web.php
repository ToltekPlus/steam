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

$router->dispatch($_SERVER['QUERY_STRING']);