<?php

namespace App\Controller;

use App\Model\BalanceModel;
use App\Policy\BalancePolicy;
use Core\View;
use App\Service\DataBuilder;

class BalanceController extends BalancePolicy{
    use DataBuilder;
	
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
    		$data = $_POST['sum'] + $balance->balance;
    		$_POST['sum'] = 0;
    	}

    	$args = $this->dataBuilder($_POST, ['balance' => $data]);

    	$balance->store($args);
    }
	
    public function check()
    {
        if((int)$_POST['sum'] >= 5000){
            return true;
        } else {
            return false;
        }
    }
}

