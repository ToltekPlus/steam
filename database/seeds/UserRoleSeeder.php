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
        $foreignKeysRoles = $this->adapter->fetchAll("SELECT id FROM roles WHERE id = 3");
        $foreignKeysUsers = $this->adapter->fetchAll("SELECT id FROM users WHERE id = 1");

        $foreignSecondKeysRoles = $this->adapter->fetchAll("SELECT id FROM roles WHERE id = 1");
        $foreignSecondKeysUsers = $this->adapter->fetchAll("SELECT id FROM users WHERE id = 2");

        $data = [
            [
                'user_id' => $foreignKeysUsers[array_rand($foreignKeysUsers)]['id'],
                'role_id' => $foreignKeysRoles[array_rand($foreignKeysRoles)]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $foreignSecondKeysUsers[array_rand($foreignSecondKeysUsers)]['id'],
                'role_id' => $foreignSecondKeysRoles[array_rand($foreignSecondKeysRoles)]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $user_role = $this->table('users_role');
        $user_role->insert($data)->save();
    }
}
