<?php

namespace App\Model;

use Core\Model;

class RoleModel extends Model{
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