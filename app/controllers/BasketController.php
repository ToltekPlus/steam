<?php

namespace App\Controller;

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

        echo $result;
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

        foreach ($explodeKeys as $item) {
            // TODO выборка данных и их подготовка к возврату
        }

        return $result;
    }
}