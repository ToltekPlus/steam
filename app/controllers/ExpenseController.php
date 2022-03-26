<?php

namespace App\Controller;

use App\Model\ExpenseModel;
use App\Policy\ExpensePolicy;
use Core\View;
use App\Service\DataBuilder;
use App\Model\HistoryExpenseModel;

class ExpenseController extends ExpensePolicy{
    use DataBuilder;
    
    /**
     * Максимальная сумма пополнения
     * @var integer
     */
    private $max_sum = 5000;
    //private $pivot_tables = ["table" => "types_operation", "foreign_key" => "type_operation_id"];
    
    /**
     * Вывод главной страницы баланса
     * @throws /Exception
     */
    public function index()
    {
        $expense = new ExpenseModel();
        $result = $expense->all();

        View::render('administrator/expenses/index.php', ['expenses' => $result]);
    }

    public function confirm()
    {
        View::render('administrator/expenses/confirm.php', ['sum' => $_POST['sum']]);
    }
    
    /**
     * Изменение баланса для снятия или пополнения
     * @param $sum int
     * @param $action '+' or '-'
     * @return int
     */
    public function changeExpense($sum, $action) : int
    {
        $expenses = new ExpenseModel();
        $expense = $expenses->find($_POST['id'])->balance;
        $sum = (int)$sum;
        
        if($this->check()){
            switch ($action) {
                case '+':
                    return $expense = $expense + $sum;
                    break;

                case '-':
                    return $expense = $expense - $sum;
                    break;
                
                default:
                    return $expense;
                    break;
            }
        }
    }

    /**
     * Вывод формы пополнения
     * @throws /Exception
     */
    public function showStore()
    {
        $expense = new ExpenseModel();
        $result = $expense->all();

        View::render('administrator/expenses/replenish.php', ['expenses' => $result]);
    }
    
    /**
     * Вывод истории баланса
     * @throws /Exception
     */
    public function showHistory()
    {
       $expense = new HistoryExpenseModel();
       $result = array_slice($expense->all(), 0, 50, true);
       //TODO: выводить информацию из пивотных таблиц

       View::render('administrator/expenses/history.php', ['expenses' => $result]);
    }
  
    /*
     * Добавление данных в таблицу баланса
     */
    public function replenish() : void
    {
        $balances = new ExpenseModel();
        $balance = $balances->find($_POST['id']);

        $userId = $balance->user_id; 
        $data = $this->changeExpense($_POST['sum'], '+');
        $args = $this->dataBuilder($_POST, ['balance' => $data, 'user_id' => $userId]);

        $this->storeToHistory();
        $this->update($args);
        $this->index();        
    }
    
    /*
     * Добавление данных в таблицу истории баланса
     */
    public function storeToHistory()
    {
        $expenses = new HistoryExpenseModel();
        $expense = $expenses->find($_POST['id']);
        
        $data = $expense->balance;
        $sum = (int)$_POST['sum'];
        $userId = $balance->user_id;

        $args = $this->dataBuilder($_POST, ['balance' => $data, 'sum' => $sum, 'user_id' => $userId]);
        $expenses->store($args);
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
        $balance = new ExpenseModel();
        $balance->update($_POST['id'], $args);
    }
  
    /*
     * Удаление данных из таблицы
     */
    public function delete()
    {
        $balance = new ExpenseModel;
        $balance->delete($_POST['id']);
    }
}
