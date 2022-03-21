<?php

namespace App\Model;

use Core\Model;

class TaxGameModel extends Model {
    /**
     * @var string
     */
    protected $table = 'taxes_game';

    protected $pivot_tables = [
        ["table" => "games", "foreign_key" => "game_id"]
    ];

    /**
     * @param $args
     * @return void
     */
    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
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
     * @param int $id
     * @return object
     */
    public function find(int $id) : object
    {
        $genre = $this->getByIdFromTable($this->table, $id, "game_id");
        return array_shift($genre);
    }

    /**
     * @param $limit
     * @return array
     */
    static function summaryInformation($limit) : array
    {
        $games = new TaxGameModel();
        $selected_tables = $games->selected_tables($games->table, $games->pivot_tables);
        return $games->getAllPivot($selected_tables, null,$limit);
    }
}