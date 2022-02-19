<?php

namespace App\Controller;

use App\Model\BasketModel;
//use App\Policy\BasketPolicy;
use Core\View;

class BasketController //extends BasketPolicy
{
    /*public function __construct()
    {
        //parent::__construct();
    }*/

    /**
     * @throws \Exception
     */
    public function index() : void
    {
        $baskets = new BasketModel();
        $result = $baskets->all();

        View::render('basket/index.php', ['baskets' => $result]);
    }
}