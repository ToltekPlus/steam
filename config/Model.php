<?php

namespace Core;

use App\Service\QueryBuilder;

class Model {
    use QueryBuilder;

    /**
     * @var Database
     */
    public $connect;

    /**
     * Реализуем подключение к БД
     */
    public function __construct()
    {
        $this->connect = new Database();
    }

    /**
     * @param string $table
     * @return array
     */
    public function getAll(string $table) : array
    {
        $sql = "SELECT * FROM {$table}";
        return $this->connect->query($sql);
    }

    /**
     * @param string $table
     * @return object
     */
    public function countRecords(string $table) : object
    {
        $sql = "SELECT count('id') as count FROM {$table}";
        $result = $this->connect->query($sql);
        return reset($result);
    }

    /**
     * @param array $tables
     * @return array
     */
    public function getAllPivot(array $tables) : array
    {
        $sql = $this->queryBuilder($tables, 0);
        return $this->connect->query($sql);
    }

    /**
     * @param array $tables
     * @param int $id
     * @return array
     */
    public function getById(array $tables, int $id) : array
    {
        $sql = $this->queryBuilder($tables, $id);
        return $this->connect->query($sql);
    }

    /**
     * Составляем список таблиц для запроса и связующие ключи
     *
     * @param string $table
     * @param array $pivot
     * @return array
     */
    public function selected_tables(string $table, array $pivot) : array
    {
        $result = [];
        array_push($result, ["table" => $table, "group_key" => "id"]);

        foreach ($pivot as $key => $value) {
            array_push($result, $value);
        }

        return $result;
    }

    /**
     * @param $field
     * @param $table
     * @param $sid
     * @return array
     */
    public function getAuthRole(string $field, string $table, int $sid) : array
    {
        $sql = "SELECT " . $field . " FROM " . $table . " WHERE user_id = " . $sid;
        return $this->connect->query($sql);
    }

    /**
     * @param $table
     * @param $fields
     * @return void
     */
    public function storeToTable($table, $fields)
    {
        // TODO декомпозировать и исправить недочеты
        $set = '';
        $values = '';

        $array = array_keys($fields);
        $last_key = end($array);

        foreach ($fields as $key => $value) {
            if ($key == $last_key) {
                $values .= ':' . $key;
                $set .= $key;
            }else {
                $values .= ':' . $key . ',';
                $set .= $key . ',';
            }
        }

        $sql = 'INSERT INTO ' . $table . " (" .$set . ") VALUES (" . $values . ")";

        $this->connect->execute($sql, $fields);
    }
}