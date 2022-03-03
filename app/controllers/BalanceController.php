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
    
    public function store() : void
    {
    	$balance = new BalanceModel();
    	$balances = $balance->all();

    	foreach($balances as $balance){
    		$_POST['balance'] = $_POST['sum'] + $balance->balance;
    		$_POST['sum'] = 0;
    	}

    	$args = $this->dataBuilder($_POST);

    	$balance->store($args);
    }
}
