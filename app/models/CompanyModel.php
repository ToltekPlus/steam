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
}