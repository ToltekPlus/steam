<?php

namespace App\Model;

use Core\Model;
use Core\DataBuilder;

class ExpenseModel extends Model{
    /**
     * @var string
     */
    protected $table = 'expenses';

    /**
     * Сбор всех данных из таблицы баланса
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    /**
     * Добавление данных в таблицу баланса
     * @param $args array
     */
    public function store($args)
    {
	    return $this->storeToTable($this->table, $args);
    }

    /**
     * Сбор всех юзеров из таблицы
     *
     * @return array
     */
    public function getUsers() : array
    {
        $all = $this->getAll($this->table);
        $account = new AccountModel();
        $users = [];
        for($i = 0;count($all) > $i;$i++){
            //array_push($users, $all[$i]->user_id);
            $full_name = $account->getFullName($all[$i]->user_id);
            $full_name = $full_name['name'] . " " . $full_name['surname'];
            $users[$i]['id'] = $all[$i]->user_id;
            $users[$i]['full_name'] = $full_name;
        }
        return $users;
    }

	/**
     * Забирает данные по id
     * @return array
     */
    public function find($id)
    {
    	$expense = $this->getByIdFromTable($this->table, (int)$id);
        return array_shift($expense);
    }

    /**
     * Забирает данные по user_id
     * @return array
     */
    public function findUserBalance($id)
    {
        $expense = $this->getByIdFromTable($this->table, (int)$id, 'user_id');
        return $expense;
    }

	/**
     * Обновление данных из таблицы по id
     * @param $id int
     * @param $args array
     */
    public function update($id, $args)
    {
        $this->updateForTable($this->table, $id, $args);
    }

	/**
     * Удаление данных из таблицы по id
     * @param $id int
     */
    public function delete($id)
    {
        $args = ['id' => $id];
        return $this->deleteFromTable($this->table, $args);
    }
}
