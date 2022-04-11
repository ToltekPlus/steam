<?php

namespace App\Model;

use Core\Model;

class AccountModel extends Model {
    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id) : object
    {
        $company = $this->getByIdFromTable($this->table, $id, 'user_id');
        return array_shift($company);
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
