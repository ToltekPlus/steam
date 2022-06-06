<?php

namespace App\Model;

use App\Rule\ModelInterface;
use Core\Model;

class ImageGameModel extends Model {
    /**
     * @var string
     */
    protected $table = 'images_game';

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
     * @return array
     */
    public function find(int $id) : array
    {
        $images = $this->getByIdFromTable($this->table, $id, "game_id");
        return $images;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findForDelete(int $id) : object
    {
        $image = $this->getByIdFromTable($this->table, $id);
        return array_shift($image);
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
