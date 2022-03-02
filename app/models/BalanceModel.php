<?php

namespace App\Model;

use Core\Model;

class BalanceModel extends Model{
    
    protected $table = 'balances';

    public function all() : array
    {
        return $this->getAll($this->table);
    }

}
