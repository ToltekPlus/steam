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
     * @param int $id
     * @return object
     */
    public function find(int $id) : object
    {
        $user = $this->getByIdFromTable($this->table, $id);
        return array_shift($user);
    }

    /**
     * @param $args
     * @param $id
     * @return void
     */
    public function update($args, $id)
    {
        return $this->updateForTable($this->table, $id, $args);
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
