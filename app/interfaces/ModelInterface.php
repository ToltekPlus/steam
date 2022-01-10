<?php

namespace App\Rule;

interface ModelInterface {
    public function all();
    public function getById();
    public function editById();
    public function update();
    public function deleteById();
}