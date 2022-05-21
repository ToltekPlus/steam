<?php


use Phinx\Seed\AbstractSeed;

class AccountSeeder extends AbstractSeed
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
        $foreignKeysUsers = $this->adapter->fetchAll("SELECT id FROM users WHERE id = 1");
        $foreignKeysUsersTwo = $this->adapter->fetchAll("SELECT id FROM users WHERE id = 2");

        $data = [
            [
                'user_id' => $foreignKeysUsers[array_rand($foreignKeysUsers)]['id'],
                'name' => 'Иван',
                'surname' => 'Иванов',
                'about' => 'Люблю деградировать',
                'birthday_at' => date('Y-m-d H:i:s'),
                'userpic' => '/userpic_default/userpic.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => $foreignKeysUsers[array_rand($foreignKeysUsersTwo)]['id'],
                'name' => 'Петр',
                'surname' => 'Петров',
                'about' => 'Люблю не деградировать',
                'birthday_at' => date('Y-m-d H:i:s'),
                'userpic' => '/userpic_default/userpic.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $account = $this->table('accounts');
        $account->insert($data)->save();
    }
}
