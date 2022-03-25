<?php


use Phinx\Seed\AbstractSeed;

class HistoryExepenseSeeder extends AbstractSeed
{
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
        $data = [
            [
                'balance' => 700,
                'expense_id' => 1,
                'type_operation_id' => 1,
                'status' => 1,
                'date_of_enrollment' => date('Y-m-d H:i:s',  strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'balance' => 500.50,
                'expense_id' => 1,
                'status' => 0,
                'type_operation_id' => 2,
                'date_of_enrollment' => date('Y-m-d H:i:s',  strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $history = $this->table('history_expenses');
        $history->insert($data)->save();

    }
}
