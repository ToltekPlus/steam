<?php


use Phinx\Seed\AbstractSeed;

class GenreSeeder extends AbstractSeed
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
                'name_genre' => 'Хоррор',
                'icon_genre' => '',
                'icon_genre_path' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name_genre' => 'RTC',
                'icon_genre' => '',
                'icon_genre_path' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name_genre' => 'BattleRoyal',
                'icon_genre' => '',
                'icon_genre_path' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $genre = $this->table('genres');
        $genre->insert($data)->save();
    }
}
