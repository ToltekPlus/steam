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

    /**
     * Минимальная сумма пополнения
     * @var integer
     */
    private $min_sum = 100;

    /**
     * Вывод главной страницы баланса
     * @throws /Exception
     */
    public function index()
    {
        $expense = new ExpenseModel();
        $result = $expense->findUserBalance($_SESSION['sid']);

        View::render('administrator/expenses/index.php', ['expenses' => $result]);
    }

    public function confirm()
    {
        if($this->check()){
            View::render('administrator/expenses/confirm.php', ['sum' => $_POST['sum']]);
        } else {
            View::render('errors/400.php');
        }
    }

    public function get()
    {
        $expense = new ExpenseModel();
        return $expense->find($_POST['id']);
    }
    
    /**
     * Изменение баланса для снятия или пополнения
     * @param $action '+' or '-'
     */
    public function changeBalance($action, $sum)
    {
        $balance = $this->get()->balance;

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
        $expense = new ExpenseModel();
        $result = $expense->findUserBalance($_SESSION['sid']);
        //TODO: проверять input на заполненность

        View::render('administrator/expenses/replenish.php', ['expenses' => $result]);
    }
    
    /**
     * Вывод истории баланса
     * @throws /Exception
     */
    public function showHistory()
    {
       $history = new HistoryExpenseModel();
       $result = array_slice($history->all(), 0, 50, true);

       foreach($result as $expense):
       switch ($expense->status) {
                case '1':
                    $expense->status = 'Выполнено';
                    break;
                case '0':
                    $expense->status = 'Невыполнено';
                    break;
            };

        endforeach;

       View::render('administrator/expenses/history.php', ['expenses' => $result]);
    }
  
    /*
     * Добавление данных в таблицу баланса
     */
    public function replenish() : void
    {
        $expense = $this->get();

        $userId = $expense->user_id; 
        $data = $this->changeBalance('+', $_POST['sum']);
        $all = $this->dataBuilder($_POST, ['balance' => $data, 'user_id' => $userId]);
        $args = array_slice($all, 3, 6, true);

        if($this->check()){
            $this->storeToHistory();
            $this->update($args);
            $this->index();        
        }
    }
    
    /*
     * Добавление данных в таблицу истории баланса
     */
    public function storeToHistory()
    {
        $expense = $this->get();
        
        $balance = $expense->balance;
        $date = date('Y-m-d H:i:s', time());
        $id = $expense->id;

        $all = $this->dataBuilder($_POST, ['status' => 1, 'date_of_enrollment' => $date, 'expense_id' => $id]);
        $args = array_slice($all, 0, 1, true) + array_slice($all, 2, 6, true);
        
        $history = new HistoryExpenseModel();
        $history->store($args);
    }

    /**
     * Проверка данных введённых в форму 
     * @return bool
     */
    public function check()
    {
        $sum = $_POST['sum'];

        if(!is_null($sum)){
            if(is_numeric($sum)){
                if((int)$sum <= $this->max_sum && (int)$sum >= $this->min_sum)
                {
                    return true;
                }
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
