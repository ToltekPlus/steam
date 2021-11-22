<?php

// подключаем автозагрузчик
require_once __DIR__ . '/../vendor/autoload.php';
// подключаем env файлы
require(__DIR__ . '/../env.php');
// подключаем БД
require_once "../config/Database.php";

// вызываем конструктор БД
$db = new \Core\Database();