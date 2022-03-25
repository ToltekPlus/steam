<?php

namespace App\Model;

use Core\Model;
use Core\DataBuilder;

class ExpenseModel extends Model{
    
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
	    $this->storeToTable($this->table, $args);
    }
	
	/**
     * Забирает по id
     * @return array
     */
    public function find($id)
    {
    	$balance = $this->getByIdFromTable($this->table, (int)$id);
        return array_shift($balance);
    }

    /**
     * Забирает по id user
     * @return array
     */
    public function findUser()
    {
        $balance = $this->getByIdFromTable($this->table, $_SESSION['sid'], 'user_id');
        return array_shift($balance);
    }
	
	/**
     * Обновление данных из таблицы по id
     * @param $id int
     * @param $args array
     */
    public function update($id, $args)
    {
        $this->builderForUpdate($id, $this->table, $args);
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
