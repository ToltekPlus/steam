<?php

namespace App\Model;

use Core\Model;

class BasketModel extends Model{
    /**
     * @var string
     */
    protected $table = "baskets";

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }
    
}