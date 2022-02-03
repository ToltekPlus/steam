<?php

namespace App\Rule;

interface ModelInterface {
    public function all();
    public function find(int $id);
    public function store(array $array);
    public function update(array $array, int $id);
    public function delete(int $id);
}