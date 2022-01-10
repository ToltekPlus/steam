<?php

use Core\Router;

$router = new Router();
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
//$router->add('roles/role?{id}', ['controller' => 'UserRoleController', 'action' => 'get']);

$router->dispatch($_SERVER['QUERY_STRING']);