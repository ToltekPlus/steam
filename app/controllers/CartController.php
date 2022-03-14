<?php

namespace App\Controller;

use App\Model\GameModel;

class CartController {
    /**
     * @var
     */
    public $keys_cart;

    /**
     * @return void
     */
    public function brief()
    {
        $result = [];

        foreach ($_POST as $key => $item) {
            $this->keys_cart = $key;
        }

        $delimiter_keys = explode(',', $this->keys_cart);

        foreach ($delimiter_keys as $key => $delimiter_key) {
            $game = new GameModel();
            $game = $game->find($delimiter_key);
            $result[$key]['name_game'] = $game->name_game;
            $result[$key]['price'] = $game->base_price;
        }

        echo json_encode($result);
    }
}