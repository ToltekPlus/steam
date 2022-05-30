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
     * @var \string[][]
     */
    protected $pivot_tables = [
        ["table" => "companies", "foreign_key" => "company_id"],
        ["table" => "genres", "foreign_key" => "genre_id"]
    ];

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
     * @param int $id
     * @return array
     */
    public function findByGenre(int $id) : array
    {
        $genre = $this->getByIdFromTable($this->table, $id, 'genre_id');
        return $genre;
    }

    /**
     * @param int $id
     * @return array
     */
    public function findByCompany(int $id) : array
    {
        $company = $this->getByIdFromTable($this->table, $id, 'company_id');
        return $company;
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

    /**
     * @param $id
     * @return object
     */
    static function summaryInformation($id) : object
    {
        $games = new GameModel();
        $selected_tables = $games->selected_tables($games->table, $games->pivot_tables);
        return $games->getAllPivot($selected_tables, $id)[0];
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
