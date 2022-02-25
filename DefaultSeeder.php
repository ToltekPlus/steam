<?php


use Phinx\Seed\AbstractSeed;

class DefaultSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'UserSeeder',
            'RoleSeeder',
            'UserRoleSeeder',
            'CompanySeeder'
        ];
    }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {

    }
}
