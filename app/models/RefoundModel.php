<?php

namespace App\Model;

use Core\Model;

class RefoundModel extends Model {
    /**
     * @var string
     */
    protected $table = 'refund_orders';

    protected $pivot_tables = [
        ["table" => "orders", "foreign_key" => "order_id"]
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
        $order = $this->getByIdFromTable($this->table, $id, "order_id");
        return array_shift($order);
    }

    /**
     * @param $limit
     * @return array
     */
    static function summaryInformation($limit) : array
    {
        $refund_orders = new RefoundModel();
        $selected_tables = $refund_orders->selected_tables($refund_orders->table, $refund_orders->pivot_tables);
        return $refund_orders->getAllPivot($selected_tables, null,$limit);
    }
}