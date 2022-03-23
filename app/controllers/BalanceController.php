<?php

namespace App\Controller;

use App\Model\BalanceModel;
use App\Policy\BalancePolicy;
use Core\View;
use App\Service\DataBuilder;
use App\Model\BalanceHistoryModel;

class BalanceController extends BalancePolicy{
    use DataBuilder;
    
    /**
     * Максимальная сумма пополнения
     * @var integer
     */
    private $max_sum = 5000;
    
    /**
     * Вывод главной страницы баланса
     * @throws /Exception
     */
    public function index()
    {
        $balance = new BalanceModel();
        $result = $balance->all();

        View::render('administrator/balances/index.php', ['balances' => $result]);
    }
    
    /**
     * Вывод формы пополнения
     * @throws /Exception
     */
    public function showStore()
    {
        $balance = new BalanceModel();
        $result = $balance->all();

        View::render('administrator/balances/replenish.php', ['balances' => $result]);
    }
    
    /**
     * Вывод истории баланса
     * @throws /Exception
     */
    public function showHistory()
    {
       $balance = new BalanceModel();
       $result = $balance->allHistory(); 

       View::render('administrator/balances/history.php', ['balances' => $result]);
    }
    
    /**
     * Изменение баланса для снятия или пополнения
     * @param $sum int
     * @param $action '+' or '-'
     * @return int
     */
    public function changeBalance($sum, $action) : int
    {
        $balances = new BalanceModel();
        $balance = $balances->find($_POST['id'])->balance;
        $sum = (int)$sum;
        
        if($this->check()){
            if($action == '+'){
                return $balance = $balance + $sum;
            } else if($action == '-'){
                return $balance = $balance - $sum;
            } else {
                return $balance;
            }
        } return 0;
    }
  
    /*
     * Добавление данных в таблицу баланса
     */
    public function replenish() : void
    {
            $balances = new BalanceModel();
            $balance = $balances->find($_POST['id']);

            $userId = $balance->user_id; 
            $data = $this->changeBalance($_POST['sum'], '+');
            $args = $this->dataBuilder($_POST, ['balance' => $data, 'user_id' => $userId]);

            $this->storeToHistory();
            $this->update($args);        
    }
    
    /*
     * Добавление данных в таблицу истории баланса
     */
    public function storeToHistory()
    {
        $balances = new BalanceModel();
        $balance = $balances->find($_POST['id']);
        
        $data = $balance->balance;
        $sum = (int)$_POST['sum'];
        $userId = $balance->user_id;

        $args = $this->dataBuilder($_POST, ['balance' => $data, 'sum' => $sum, 'user_id' => $userId]);
        $balances->storeToHistoryBalance($args);
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
     * Обновление данных таблицы
     */
    public function update($args)
    {
        $balance = new BalanceModel();
        $balance->update($_POST['id'], $args);
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
