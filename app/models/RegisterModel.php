<?php

namespace App\Model;

use App\Rule\ModelInterface;
use Core\Model;

class RegisterModel extends Model {
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    /**
     * @param $args
     * @return void
     */
    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
    }

    /**
     * @param $args
     * @param $id
     * @return void
     */
    public function update($args, $id)
    {
        return $this->updateForTable($this->table, $id, $args);
    }
}