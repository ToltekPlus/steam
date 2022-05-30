<?php


use Phinx\Seed\AbstractSeed;

class CompanySeeder extends AbstractSeed
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
                'name_company' => 'EA',
                'description_company' => 'Все о еа',
                'logotype_company' => '',
                'visibility' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name_company' => 'Blizzard',
                'description_company' => 'Все о близах',
                'logotype_company' => '',
                'visibility' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $company = $this->table('companies');
        $company->insert($data)->save();
    }
}
