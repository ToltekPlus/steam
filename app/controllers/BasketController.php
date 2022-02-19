<?php

namespace App\Controller;

use App\Model\UserRoleModel;
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
    public function index()
    {
        $baskets = BasketModel::all();

        View::render('basket/index.php', ['baskets' => $baskets]);
    }
}