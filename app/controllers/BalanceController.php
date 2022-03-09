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
        $mainBalance = new BalanceModel();

        if($this->check()){
	    $balance = $this->find($_POST['id']);
            
            $data = $_POST['sum'] + $balance->balance;
	    $userId = $balance->user_id;
            
            $args = $this->dataBuilder($_POST, ['balance' => $data]);
		
	    $this->storeToHistory();
            $this->delete();
	    $mainBalance->store($args);
        }
    }

    public function check()
    {
        if(is_numeric($_POST['sum'])){
            if((int)$_POST['sum'] >= 5000){
                return true;
            }
        }
        return false;
    }
	
    public function storeToHistory()
    {
        $balance = $this->find($_POST['id']);
        $data = $balance->balance;
        $sum = (int)$_POST['sum'];
        $userId = $balance->user_id;

        $args = $this->dataBuilder($_POST, ['balance' => $data, 'sum' => $sum, 'user_id' => $userId]);
        $this->storeToHistoryBalance($args);
    }

    public function delete()
    {
        $balance = new BalanceModel;
        $balance->delete($_POST['id']);
    }
}

