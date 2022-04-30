<?php
namespace App\Model;

use Core\Model;

class OrderModel extends Model {
    /**
     * @var string
     */
    protected $table = "orders";

    protected $pivot_tables = [
        ["table" => "games", "foreign_key" => "game_id"],
        ["table" => "users", "foreign_key" => "user_id"]
    ];

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->getAll($this->table);
    }

    static function allGamesForUser()
    {
        $games = new OrderModel();
        $selected_tables = $games->selected_tables($games->table, $games->pivot_tables);
        return $games->getAllPivot($selected_tables);
    }

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id)   : object
    {
        $orders = $this->getByIdFromTable($this->table, $id, 'game_id');
        return array_shift($orders);
    }
    
    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $Games = ['id' => $id];
        return $this->deleteFromTable($this->table, $Games);
    }

}
?>
