<?php


use Phinx\Seed\AbstractSeed;

class OrderRefandSeeder extends AbstractSeed
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
                'refund' => 1,
                'refund_block' => 0,
                'comments' => 'Очень недоволен оптимизацией игры',
                'order_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $refund = $this->table('refund_orders');
        $refund->insert($data)->save();
    }
}
