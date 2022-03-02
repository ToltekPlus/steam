<?php

namespace App\Controller;

use App\Model\BalanceModel;
use App\Policy\BalancePolicy;
use Core\View;
use App\Rule\ControllerInterface;

class BalanceController extends BalancePolicy{
    public function index()
    {
        $balance = new BalanceModel();
        $result = $balance->all();

        View::render('administrator/balances/index.php', ['balances' => $result]);
    }
}
