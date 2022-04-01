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
        $expenses = new ExpenseModel();
        $result = $expenses->findUserBalance($_SESSION['sid']);

        View::render('administrator/expenses/index.php', ['expenses' => $result]);
    }

    public function confirm()
    {
        View::render('administrator/expenses/confirm.php', ['sum' => $_POST['sum']]);
    }

    public function get()
    {
        $expenses = new ExpenseModel();
        return $expenses->find($_POST['id']);
    }
    
    /**
     * Изменение баланса для снятия или пополнения
     * @param $action '+' or '-'
     */
    public function changeBalance($action)
    {
        $balance = $this->get()->balance;
        $sum = $_POST['sum'];
        
        if($this->check()){
            switch ($action) {
                case '+':
                    return $balance + $sum;
                    break;

                case '-':
                    return $balance - $sum;
                    break;
                
                default:
                    return $balance;
                    break;
            }
        } else {
            View::render('errors/400.php');
        }
    }

    /**
     * Вывод формы пополнения
     * @throws /Exception
     */
    public function showStore()
    {
        $expenses = new ExpenseModel();
        $result = $expenses->findUserBalance($_SESSION['sid']);
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
        $expense = $this->get();

        $userId = $expense->user_id; 
        $data = $this->changeBalance('+');
        $args = $this->dataBuilder($_POST, ['balance' => $data, 'user_id' => $userId]);

        $this->storeToHistory();
        $this->update($args);
        if($this->check()){
            $this->index();        
        }
    }
    
    /*
     * Добавление данных в таблицу истории баланса
     */
    public function storeToHistory()
    {
        //TODO: сделать так, чтобы данные заполнялись в БД
        $expenses = new HistoryExpenseModel();
        $expense = $this->get();
        
        $data = $expense->balance;
        $sum = $_POST['sum'];
        $userId = $expense->user_id;

        $args = $this->dataBuilder($_POST, ['balance' => $data, 'sum' => $sum, 'user_id' => $userId]);
        
        $expenses->store($args);
    }

    /*
     * Проверка данных введённых в форму 
     */
    public function check()
    {
        if(is_numeric($_POST['sum'])){
            if((int)$_POST['sum'] <= $this->max_sum)
            {
                return true;
            }
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
