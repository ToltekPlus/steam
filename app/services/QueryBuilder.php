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
    public function queryBuilder(array $tables, ?int $id, $limit) : string
    {
        $selected_table = "";
        $limit_data = "";
        foreach ($tables as $key => $table) {
            if ($key == array_key_last($tables)) {
                $selected_table .= $table['table'];
            }else {
                $selected_table .= $table['table'] . ', ';
            }
        }
        $where = $this->queryConditionWhereBuilder($tables, $id);

        $table_key = $tables[0]['table'] . "." . $tables[0]['group_key']  ." as table_id";

        if (!is_null($limit)) $limit_data = " LIMIT " . $limit;

        return "SELECT *, " . $table_key . " FROM " . $selected_table . $where . $limit_data;
    }

    /**
     * Подготавливаем условие WHERE
     *
     * @param array $tables
     * @param int|null $id
     * @return string
     */
    public function queryConditionWhereBuilder(array $tables, ?int $id) : ?string
    {
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
        if ($id != null) return ' AND ' . $tables[0]['table']. '.id = ' . $id;
    }
}