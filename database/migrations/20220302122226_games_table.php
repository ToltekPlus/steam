<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class GamesTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('games');
        if ($exists) {
            $this->table('games')->drop()->save();
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
        $table = $this->table( 'games');
        $table->addColumn( 'name_game', 'string')
            ->addColumn( 'description_game', 'string')
            ->addColumn( 'cover_game', 'string')
            ->addColumn( 'base_price', 'float')
            ->addColumn( 'created_at', 'datetime' )
            ->addColumn( 'updated_at', 'datetime' )
            ->create();

        $refTable = $this->table('games');
        $refTable->addColumn('company_id', 'integer', ['null' => true])
            ->addForeignKey('company_id', 'companies', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

        $refTable = $this->table('games');
        $refTable->addColumn('genre_id', 'integer', ['null' => true])
            ->addForeignKey('genre_id', 'genres', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
