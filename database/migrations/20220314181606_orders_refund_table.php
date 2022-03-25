<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class OrdersRefundTable extends AbstractMigration
{
    public function up() : void
    {
        $exists = $this->hasTable('orders_refund');
        if ($exists) {
            $this->table('orders_refund')->drop()->save();
        }
    }

    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('refund_orders');
        $table->addColumn( 'refund', 'boolean')
            ->addColumn( 'refund_block', 'boolean')
            ->addColumn( 'comments', 'string')
            ->addColumn( 'created_at', 'datetime')
            ->addColumn( 'updated_at', 'datetime')
            ->create();

        $refTable = $this->table('refund_orders');
        $refTable->addColumn('order_id', 'integer', ['null' => true])
            ->addForeignKey('order_id', 'orders', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
