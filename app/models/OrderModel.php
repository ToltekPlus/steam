<?php

namespace App\Model;

use App\Rule\ModelInterface;
use Core\Model;

class OrderModel extends Model {
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id) : object
    {
        $genre = $this->getByIdFromTable($this->table, $id);
        return array_shift($genre);
    }

    /**
     * @param $args
     * @return false|string
     */
    public function store($args)
    {;
        $this->storeToTable($this->table, $args);
        return $this->lastInsertKey();
    }
}