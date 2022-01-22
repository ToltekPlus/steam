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

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id) : object
    {
        $genre = $this->getByIdFromTable($this->table, $id);
        return array_shift($genre);
    }


    public function update($args, $id)
    {
        return $this->updateForTable($this->table, $id, $args);
    }
}