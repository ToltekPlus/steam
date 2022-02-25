<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class GamesTable extends AbstractMigration
{
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
        $table = $this->table( 'games' );
        $table->addColumn( 'name', 'varchar' )
            ->addColumn( 'price', 'float' )
            ->addColumn( 'description', 'varchar' )
            ->addColumn( 'game_pic', 'text' )
            ->addColumn( 'archive', 'tinyint' )
            ->addColumn('genre_id', 'integer')
            ->addColumn('company_id', 'integer')
            ->addColumn( 'created_at', 'datetime' )
            ->addColumn( 'updated_at', 'datetime' )
            ->create();
    }
}
