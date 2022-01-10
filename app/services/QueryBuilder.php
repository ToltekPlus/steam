<?php

namespace App\Service;

trait QueryBuilder {
    /**
     * Составляем SQL-запрос абстракто из нескольких таблиц
     * Также существует условие выборки по ID
     *
     * @param array $tables
     * @param int|null $id
     * @return string
     */
    public function queryBuilder(array $tables, ?int $id) : string
    {
        //$selected_table = implode(", ", $tables);
        // TODO переделать на спредах
        $selected_table = "";
        foreach ($tables as $key => $table) {
            if ($key == array_key_last($tables)) {
                $selected_table .= $table['table'];
            }else {
                $selected_table .= $table['table'] . ', ';
            }
        }

        $where = $this->queryConditionWhereBuilder($tables, $id);

        return "SELECT * FROM " . $selected_table . $where;
    }

    /**
     * Подготавливаем условие WHERE
     *
     * @param array $tables
     * @param int|null $id
     * @return string
     */
    public function queryConditionWhereBuilder(array $tables, ?int $id) : string
    {
        // TODO изменить условие для достоверной выборки
        $count = count($tables);

        if ($count > 1) {
            $where = ' WHERE ';
            foreach ($tables as $key => $value) {
                if ($key == 0) continue;
                if ($key == $count-1) {
                    $where .=  $tables[0]['table'] . '.' . $value['foreign_key'] . '=' . $value['table']. '.id ';
                }else {
                    $where .=  $tables[0]['table'] . '.' . $value['foreign_key'] . '=' . $value['table']. '.id AND ';
                }
            }

            $where .= $this->conditionForKey($tables, $id);

            $where .= ' GROUP BY ' . $tables[0]['table']. '.' . $tables[0]['group_key'];
        }

        return $where;
    }


    /**
     * Составляем запрос по поиску по ID
     *
     * @param $tables
     * @param $id
     * @return string|void
     */
    public function conditionForKey($tables, $id)
    {
        if ($id != 0) return ' AND ' . $tables[0]['table']. '.id = ' . $id;
    }
}