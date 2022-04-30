<?php


use Phinx\Seed\AbstractSeed;

class GameSeeder extends AbstractSeed
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
                'name_game' => 'Fifa 22',
                'description_game' => 'Описание фифули',
                'cover_game' => '',
                'base_price' => 3499,
                'visibility' => 1,
                'company_id' => 1,
                'genre_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name_game' => 'Cyberpunk 2077',
                'description_game' => 'Описание об данной игре',
                'cover_game' => '',
                'base_price' => 5499,
                'visibility' => 0,
                'company_id' => 2,
                'genre_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $game = $this->table('games');
        $game->insert($data)->save();
    }
}
