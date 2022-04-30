<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class OrdersTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('orders');
        if ($exists) {
            $this->table('orders')->drop()->save();
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
        $table = $this->table('orders');
        $table->addColumn( 'final_price', 'float')
            ->addColumn( 'count', 'integer' )
            ->addColumn( 'order_date', 'datetime' )
            ->addColumn( 'created_at', 'datetime' )
            ->addColumn( 'updated_at', 'datetime' )
            ->create();

        $refTable = $this->table('orders');
        $refTable->addColumn('user_id', 'integer', ['null' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

        $refTable = $this->table('orders');
        $refTable->addColumn('game_id', 'integer', ['null' => true])
            ->addForeignKey('game_id', 'taxes_game', 'game_id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
