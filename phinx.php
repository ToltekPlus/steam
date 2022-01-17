<?php

/**
 * Работа с миграциями и сидерами
 *
 * vendor\bin\phinx create NameTable            => создаем новую миграцию, где Name - название таблицы
 * vendor\bin\phinx migrate                     => выполняем работу всех миграций
 * vendor\bin\phinx seed:create NameSeeder      => создаем новый сидер, где Name - название сидера
 * vendor\bin\phinx seed:run -s UserSeeder      => выполняем работу сидера
 *
 */


$pdo = new PDO(
    'mysql:host=127.0.0.1;dbname=steam;charset=utf8', 'root', 'root',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_unicode_ci',
    )
);

return [
    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__  . '/database/seeds',
    ],
    'schema_file' => __DIR__ . '/database/schema/schema.php',
    'foreign_keys' => false,
    'default_migration_prefix' => '',
    'mark_generated_migration' => true,
    'environments' => [
        'default_environment' => 'local',
        'local' => [
            'name' => $pdo->query('select database()')->fetchColumn(),
            'connection' => $pdo,
        ]
    ]
];