<?php

namespace App\Controller;

use App\Model\GameModel;
use App\Model\OrderModel;
use Core\View;

class LibraryController {
    /**
     * @return void
     * @throws \Exception
     */
    public function index()
    {
        $library = new OrderModel();
        $library = $library->findByUser($_SESSION['sid']);

        $library_games = [];

        $games = new GameModel();
        foreach ($library as $key => $item) {
            $game = $games->find($item->game_id);
            $library_games[$key] = $item;
            $library_games[$key]->game = $game;
        }

        View::render('library/index.php', ['orders' => $library_games]);
    }

}
