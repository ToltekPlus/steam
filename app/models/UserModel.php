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

    /**
     * @param $field
     * @param $value
     * @return mixed|null
     */
    public function findByAuthData($field, $value)
    {
        $user = $this->getByFieldFromTable($this->table, $field, $value);
        return array_shift($user);
    }
}
