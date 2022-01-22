<?php

namespace App\Model;

use Core\Model;

class GenreModel extends Model {
    /**
     * @var string
     */
    protected $table = 'genres';

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    /**
     * @param $args
     */
    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
    }
}