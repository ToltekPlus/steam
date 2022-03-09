<?php

namespace App\Model;

use Core\Model;
use Core\DataBuilder;

class BalanceModel extends Model{
    
    protected $table = 'balances';

    public function all() : array
    {
        return $this->getAll($this->table);
    }
    
    public function store($args)
    {
	return $this->storeToTable($this->table, $args);
    }
	
    public function find($id)
    {
    	$balance = $this->getByIdFromTable($this->table, $id);
        return array_shift($balance);
    }

    public function storeToHistoryBalance($args)
    {
    	return $this->storeToTable('balance-history', $args);
    }

    public function delete($id)
    {
        $args = ['id' => $id];
        return $this->deleteFromTable($this->table, $args);
    }

}
