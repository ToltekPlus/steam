<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Model\GameModel;
use App\Model\GenreModel;
use App\Model\TaxGameModel;
use Core\View;

class BasketController {
    /**
     * @var
     */
    public $basketKeys;

    /**
     * @throws \Exception
     */
    public function index()
    {
        View::render('basket/index.php');
    }

    /**
     * Получение информации об играх из localStorage
     */
    public function getProducts()
    {
        foreach ($_POST as $key => $item) {
            $this->basketKeys = $key;
         }

        $result = $this->getInformationForBasket();

        //echo json_encode(array_shift($result));
        echo json_encode($result);
    }

    /**
     * Забираем информацию о играх из БД
     *
     * @return array
     */
    public function getInformationForBasket()
    {
        $explodeKeys = explode(',', $this->basketKeys);

        $result = [];

        foreach ($explodeKeys as $key => $item) {
            $game = new GameModel();
            $game = $game->find($item);
            $result[$key] = $game;

            $genre = new GenreModel();
            $genre = $genre->find($game->genre_id);
            $result[$key]->genre = $genre;

            $company = new CompanyModel();
            $company = $company->find($game->company_id);
            $result[$key]->company = $company;

            $tax = new TaxGameModel();
            $tax = $tax->find($item);
            $result[$key]->tax = $tax;
        }

        return $result;
    }
}