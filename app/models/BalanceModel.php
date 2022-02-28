<?php

namespace App\Model;

use Core\Model;

class BalanceModel extends Model{
    
    protected $table = 'balances';

    public function all() : array
    {
        return $this->getAll($this->table);
    }

    public function find(int $id) : object
    {
        $balance = $this->getByIdFromTable($this->table, $id);
        return array_shift($balance);
    }

    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
    }
}