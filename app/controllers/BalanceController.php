<?php

namespace App\Controller;

use App\Model\BalanceModel;
use App\Policy\BalancePolicy;
use Core\View;
use App\Service\DataBuilder;

class BalanceController extends BalancePolicy{
    use DataBuilder;
    
    public $max_sum = 5000;
    /*
     * Вывод формы 
     */
    public function index()
    {
        $balance = new BalanceModel();
        $result = $balance->all();

        View::render('administrator/balances/index.php', ['balances' => $result]);
    }
  
    /*
     * Добавление данных в таблицу баланса
     */
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

    /*
     * Проверка данных введённых в форму 
     */
    public function check()
    {
        if(is_numeric($_POST['sum']) || (int)$_POST['sum'] >= $max_sum){
            return true; 
        } return false;
    }
  
    /*
     * Удаление данных из таблицы
     */
    public function delete()
    {
        $balance = new BalanceModel;
        $balance->delete($_POST['id']);
    }
}
