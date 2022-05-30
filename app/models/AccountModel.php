<?php

namespace App\Model;

use Core\Model;

class AccountModel extends Model {
    /**
     * @var string
     */
    protected $table = 'accounts';

     /**
     * @return object
     */
    public function all()
    {
        $account = $this->getAll($this->table);
        return $account;
    }

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id)
    {
        $account = $this->getByIdFromTable($this->table, $id, 'user_id');
        return array_shift($account);
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
     * @param $args
     * @return void
     */
    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
    }

    /**
     * @param int $user_id 
     * @return array
     */
    public function getFullName($user_id)
    {
        $account = $this->find($user_id);
        $fullName = ['name' => $account->name, 'surname' => $account->surname];
        return $fullName;
    }

    /**
     * @return array
     */
    public function getAllFullNames()
    {
        $accounts = $this->all();
        $fullnames = [];
        foreach($accounts as $account){
            array_push($fullnames, ['name' => $account->name, 'surname' => $account->surname]);
        }
        return $fullnames;
    }
}
