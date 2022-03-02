<?php

namespace App\Model;

use Core\Model;

class TaxGameModel extends Model {
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
     * @return array
     */
    static function summaryInformation() : array
    {
        $games = new TaxGameModel();
        $selected_tables = $games->selected_tables($games->table, $games->pivot_tables);
        return $games->getAllPivot($selected_tables);
    }
}