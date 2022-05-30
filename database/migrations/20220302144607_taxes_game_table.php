<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TaxesGameTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('taxes_game');
        if ($exists) {
            $this->table('taxes_game')->drop()->save();
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
        $table = $this->table('taxes_game');
        $table->addColumn( 'tax', 'integer')
            ->addColumn( 'end_of_discount', 'datetime' )
            ->addColumn( 'created_at', 'datetime' )
            ->addColumn( 'updated_at', 'datetime' )
            ->create();

        $refTable = $this->table('taxes_game');
        $refTable->addColumn('game_id', 'integer', ['null' => true])
            ->addForeignKey('game_id', 'games', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
