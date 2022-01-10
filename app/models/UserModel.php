<?php

namespace App\Model;

use Core\Model;

class UserModel extends Model{
    /**
     * @var string
     */
    protected $table = "users";

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }
}