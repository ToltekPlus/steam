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
        //TODO: проверять input на заполненность

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
        //TODO: сделать так, чтобы данные заполнялись в БД
        $expenses = new ExpenseModel();
        $expense = $expenses->find($_POST['id']);

        $userId = $expense->user_id; 
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
        //TODO: сделать так, чтобы данные заполнялись в БД
        $expenses = new HistoryExpenseModel();
        $expense = $expenses->find($_POST['id']);
        
        $data = $expense->balance;
        $sum = (int)$_POST['sum'];
        $userId = $expense->user_id;

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
        $expense = new ExpenseModel();
        $expense->update($_POST['id'], $args);
    }
  
    /*
     * Удаление данных из таблицы
     */
    public function delete()
    {
        $expense = new ExpenseModel;
        $expense->delete($_POST['id']);
    }
}
