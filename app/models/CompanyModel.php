<?php

namespace App\Model;

use Core\Model;

class CompanyModel extends Model {
    /**
     * @var string
     */
    protected $table = "companies";

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    /**
     * @return object
     */
    public function count() : object
    {
        return $this->countRecords($this->table);
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
     * @param int $id
     * @return object
     */
    public function find(int $id)   : object
    {
        $company = $this->getByIdFromTable($this->table, $id);
        return array_shift($company);
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
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $args = ['id' => $id];
        return $this->deleteFromTable($this->table, $args);
    }
}
