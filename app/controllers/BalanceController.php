<?php

namespace App\Controller;

use App\Model\BalanceModel;
use App\Policy\BalancePolicy;
use Core\View;
use App\Service\DataBuilder;

class BalanceController extends BalancePolicy{
    use DataBuilder;
    
    private $max_sum = 5000;
    
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
     * Изменение баланса для снятия или пополнения
     */
    public function changeBalance($sum, $action) : int
    {
        $balance = $this->find($_POST['id']);
        if($this->check()){
            if($action == '+'){
                return $balance->balance =+ $sum;
            } else if($action == '-'){
                return $balance->balance =- $sum;
            } else {
                return $balance->balance;
            }
        } return 0;
    }
  
    /*
     * Добавление данных в таблицу баланса
     */
    public function store() : void
    {
            $balance = $this->find($_POST['id']);  

            $userId = $balance->user_id; 
            $data = changeBalance($_POST['sum'], '+');
            $args = $this->dataBuilder($_POST, ['balance' => $data]);

            $this->storeToHistory();
            $this->update($args);        
    }
    
    /*
     * Добавление данных в таблицу истории баланса
     */
    public function storeToHistory()
    {
        $balance = $this->find($_POST['id']);
        $data = $balance->balance;
        $sum = (int)$_POST['sum'];
        $userId = $balance->user_id;

        $args = $this->dataBuilder($_POST, ['balance' => $data, 'sum' => $sum, 'user_id' => $userId]);
        $this->storeToHistoryBalance($args);
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
