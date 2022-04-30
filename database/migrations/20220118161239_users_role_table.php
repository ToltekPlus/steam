<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersRoleTable extends AbstractMigration
{
    /**
     * @return void
     */
    public function up() : void
    {
        $exists = $this->hasTable('users_role');
        if ($exists) {
            $this->table('users_role')->drop()->save();
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
        $table = $this->table('users_role');
        $table->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }
}
