<?php

namespace App\Handler;

/**
 * Реализация CRUD-системы для контроллеров
 *
 * Interface CrudInterface
 * @package App\Handler
 */
interface CrudInterface {
    public function index();
    public function store();
    public function edit();
    public function update();
    public function delete();
}