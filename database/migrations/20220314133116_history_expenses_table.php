<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class HistoryExpensesTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('history_expenses');
        if ($exists) {
            $this->table('history_expenses')->drop()->save();
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
        $table = $this->table('history_expenses');
        $table->addColumn( 'balance', 'float')
            ->addColumn( 'status', 'boolean' )
            ->addColumn( 'date_of_enrollment', 'datetime' )
            ->addColumn( 'created_at', 'datetime' )
            ->addColumn( 'updated_at', 'datetime' )
            ->create();

        $refTable = $this->table('history_expenses');
        $refTable->addColumn('expense_id', 'integer', ['null' => true])
            ->addForeignKey('expense_id', 'expenses', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

        $refTableTypeOperation = $this->table('history_expenses');
        $refTableTypeOperation->addColumn('type_operation_id', 'integer', ['null' => true])
            ->addForeignKey('type_operation_id', 'types_operation', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }
}
