<?php


use Phinx\Seed\AbstractSeed;

class UserRoleSeeder extends AbstractSeed
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
                'user_id' => 1,
                'role_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 3,
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $user_role = $this->table('users_role');
        $user_role->insert($data)->save();
    }
}
