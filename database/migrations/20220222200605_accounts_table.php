<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AccountsTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('accounts');
        if ($exists) {
            $this->table('accounts')->drop()->save();
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
        $table = $this->table('accounts');
        $table->addColumn('name', 'string')
            ->addColumn('surname', 'string')
            ->addColumn('about', 'string')
            ->addColumn('birthday_at','date')
            ->addColumn('userpic', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }
}
