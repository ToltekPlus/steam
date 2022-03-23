<?php

namespace App\Model;

use Core\Model;
use Core\DataBuilder;

class BalanceModel extends Model{
    
    protected $table = 'balances';
    protected $table2 = 'balances-history';
	
    /*
     * Сбор всех данных из таблицы баланса
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }
	
	/*
     * Сбор всех данных из таблицы истории баланса
     */
    public function allHistory() : array
    {
        return $this->getAll($this->table2);
    }

    /*
     * Добавление данных в таблицу баланса
     */
    public function store($args)
    {
	return $this->storeToTable($this->table, $args);
    }
	
	/*
     * Добавление данных в таблицу истории баланса
     */
	public function storeToHistoryBalance($args)
    {
    	return $this->storeToTable($this->table2, $args);
    }
	
    /*
     * Забирает id
     */
    public function find($id)
    {
    	$balance = $this->getByIdFromTable($this->table, $id);
        return array_shift($balance);
    }
	
	/*
     * Обновление данных из таблицы по id
     */
    public function update($id, $args)
    {
        $this->builderForUpdate($id, $this->table, $args);
    }

    /*
     * Удаление данных из таблицы по id
     */
    public function delete($id)
    {
        $args = ['id' => $id];
        return $this->deleteFromTable($this->table, $args);
    }

}
