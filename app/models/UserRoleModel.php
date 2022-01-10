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
     * @param int $id
     * @return array
     */
    static function find(int $id) : array
    {
        $users_role = new UserRoleModel();
        $selected_tables = $users_role->selected_tables($users_role->table, $users_role->pivot_tables);
        return $users_role->getById($selected_tables, $id);
    }
}