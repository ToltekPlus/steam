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
        $order = $this->getByIdFromTable($this->table, $id);
        return array_shift($order);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findByUser(int $id) : array
    {
        $orders = $this->getByIdFromTable($this->table, $id, "user_id");
        return $orders;
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
