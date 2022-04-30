<?php


use Phinx\Seed\AbstractSeed;

class MainSeeder extends AbstractSeed
{
    /**
     * Записываем классы сидеров
     *
     * @var string[]
     */
    protected $seedClasses = [
        UserSeeder::class,
        RoleSeeder::class,
        UserRoleSeeder::class,
        AccountSeeder::class,
        CompanySeeder::class,
        GenreSeeder::class,
        GameSeeder::class,
        TaxGameSeeder::class,
        TypeOperationSeeder::class,
        ExpenseSeeder::class,
        HistoryExepenseSeeder::class,
        OrderSeeder::class,
        OrderRefandSeeder::class
    ];

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
        foreach ($this->seedClasses as $seedClass) {
            $seeder = new $seedClass;
            $seeder->setAdapter($this->getAdapter()); // this is required to set the database connection
            $seeder->run();
        }

    }
}
