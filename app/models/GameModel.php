<?php

namespace App\Model;

use App\Rule\ModelInterface;
use Core\Model;

class GameModel extends Model implements ModelInterface {
    /**
     * @var string
     */
    protected $table = 'games';

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
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

    /**
     * @param $args
     * @return false|string
     */
    public function store($args)
    {;
        $this->storeToTable($this->table, $args);
        return $this->lastInsertKey();
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

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}