<?php

namespace App\Model;

use Core\Model;

class UserRoleModel extends Model {
    /**
     * @var string
     */
    protected $table = "users_role";

    /**
     * @var \string[][]
     */
    protected $pivot_tables = [
        ["table" => "users", "foreign_key" => "user_id"],
        ["table" => "roles", "foreign_key" => "role_id"]
    ];

    /**
     * @return array
     */
    static function all() : array
    {
        $users_role = new UserRoleModel();
        $selected_tables = $users_role->selected_tables($users_role->table, $users_role->pivot_tables);
        return $users_role->getAllPivot($selected_tables);
    }

    /**
     * @param $field
     * @param $value
     * @return array
     */
    public function findByRole($field, $value)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $field . " = " . $value . " GROUP BY id";
        return $this->connect->query($sql);
    }

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id) : object
    {
        $users_role = new UserRoleModel();
        $selected_tables = $users_role->selected_tables($users_role->table, $users_role->pivot_tables);
        return array_shift($users_role->getAllPivot($selected_tables, $id));
    }

    /**
     * Возвращаем роль пользователя
     *
     * @return array
     */
    public function getByAuthId()
    {
        return $this->getAuthRole('role_id', $this->table, (int)$_SESSION['sid'])[0]->role_id;
    }

    /**
     * @param $args
     * @return void
     */
    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
    }
}
