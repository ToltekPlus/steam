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

}
