<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TypesOperationTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('types_operation');
        if ($exists) {
            $this->table('types_operation')->drop()->save();
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
        $table = $this->table('types_operation');
        $table->addColumn( 'type_operation', 'string')
            ->addColumn( 'created_at', 'datetime' )
            ->addColumn( 'updated_at', 'datetime' )
            ->save();
    }
}
