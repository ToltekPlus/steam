<?php

namespace Core;

use App\Service\QueryBuilder;
use Core\Logger;

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
     * Выборка из одной таблице по id
     *
     * @param string $table
     * @param int $id
     * @return array
     */
    public function getByIdFromTable(string $table, int $id) : array
    {
        $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
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
    public function storeToTable($table, $args)
    {
        // TODO декомпозировать и исправить недочеты
        $set = '';
        $values = '';

        $array = array_keys($args);
        $last_key = end($array);

        foreach ($args as $key => $value) {
            if ($key == $last_key) {
                $values .= ':' . $key;
                $set .= $key;
            }else {
                $values .= ':' . $key . ',';
                $set .= $key . ',';
            }
        }

        $sql = 'INSERT INTO ' . $table . " (" .$set . ") VALUES (" . $values . ")";

        $this->executeQuery($sql, $args);
    }

    /**
     * @param $table
     * @param $id
     * @param $args
     */
    public function updateForTable($table, $id, $args)
    {
        $sql = $this->builderForUpdate($id, $table, $args);

        $this->executeQuery($sql, $args);
    }

    /**
     * @param $id
     * @param $table
     * @param $fields
     * @return string
     */
    public function builderForUpdate($id, $table, $fields)
    {
        $set = ' SET ';
        $array = array_keys($fields);
        $last_key = end($array);

        foreach ($fields as $key => $value) {
            if ($key == $last_key) {
                $set .= $key . ' = :' . $key;
            }else {
                $set .= $key . '= :' . $key . ', ';
            }
        }

        $sql = 'UPDATE ' . $table . $set . ' WHERE id=' . $id;

        return $sql;
    }

    /**
     * @param $table
     * @param $args
     * @return bool
     */
    public function deleteFromTable($table, $args)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE id = :id';

        $this->executeQuery($sql, $args);

        return true;
    }

    /**
     * @param $sql
     * @param $args
     * @return void
     */
    public function executeQuery($sql, $args) : void
    {
        try {
            $this->connect->execute($sql, $args);
        }catch (\Exception $e) {
            Logger::getLogger()->log('sql', $e->getMessage());
        }
    }
}