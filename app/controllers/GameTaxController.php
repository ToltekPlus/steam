<?php

namespace App\Controller;

use App\Model\GameModel;
use App\Model\TaxGameModel;
use App\Policy\TaxGamePolicy;
use App\Service\DataBuilder;
use Core\View;

class GameTaxController extends TaxGamePolicy {
    use DataBuilder;

    /**
     * @return void
     * @throws \Exception
     */
    public function create()
    {
        $game = new GameModel();
        $game = $game->find($_GET['id']);

        View::render('administrator/taxes_game/create.php', ['game' => $game]);
    }

    /**
     * @return void
     */
    public function store()
    {
        $args = $this->dataBuilder($_POST);

        $genre = new TaxGameModel();
        $genre->store($args);
    }

    // TODO обновление скидки
    // TODO Добавление скидки при добавлении игры
}