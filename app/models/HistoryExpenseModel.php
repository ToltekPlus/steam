<?php

namespace App\Model;

use Core\Model;

class HistoryExpenseModel extends Model {

	protected $table = 'history_expenses';

    /**
     * Сбор всех данных из таблицы истории баланса
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    /**
     * Добавление данных в таблицу истории баланса
     * @param $args
     */
	public function store($args)
    {
    	$this->storeToTable($this->table, $args);
    }

    /**
     * Забирает id
     * @return array
     */
    public function find($id)
    {
    	$balance = $this->getByIdFromTable($this->table, (int)$id);
        return array_shift($balance);
    }
}
