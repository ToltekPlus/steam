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
}