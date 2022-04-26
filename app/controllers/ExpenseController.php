<?php

namespace App\Controller;

use App\Model\ExpenseModel;
use App\Policy\ExpensePolicy;
use Core\View;
use App\Service\DataBuilder;
use App\Model\HistoryExpenseModel;
use App\Model\AccountModel;

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
        $accounts = new AccountModel();
        $users = $expense->getUsers();

        //TODO: сократить или переместить этот if в другую функцию
        if($this->checkUser($_POST['user'])){
            $result = $expense->findUserBalance($_POST['user']);
            $account = $accounts->getFullName($_POST['user']);
        } else {
            if($this->checkUser($_GET['id'])){
                $result = $expense->findUserBalance($_GET['id']);
                $account = $accounts->getFullName($_GET['id']);
            } else {
                $result = $expense->findUserBalance($_SESSION['sid']);
                $account = $accounts->getFullName($_SESSION['sid']);
            } 
        }
        
        View::render('administrator/expenses/index.php', ['expenses' => $result, 'users' => $users, 'account' => $account]);
    }

    /**
     * Вывод окна подтверждения
     * @return void
     * @throws \Exception
     */
    public function confirm()
    {
        if($this->checkSum($_POST['balance'])){
            View::render('administrator/expenses/confirm.php', ['balance' => $_POST['balance']]);
        } else {
            View::render('errors/400.php');
        }
    }

    /**
     * Получение баланса
     * 
     * @return array
     */
    public function get()
    {
        $expense = new ExpenseModel();
        return $expense->find($_POST['id']);
    }

    /**
     * Изменение баланса для снятия или пополнения
     * 
     * @param '+' or '-' $action 
     * @throws \Exception
     */
    public function changeBalance($action, $sum)
    {
        $balance = $this->get()->balance;

        if($this->checkSum($sum)){
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
     * 
     * @throws /Exception
     */
    public function showStore()
    {
        $expense = new ExpenseModel();
        $result = $expense->findUserBalance($_POST['user']);
        $users = $expense->getUsers();

        View::render('administrator/expenses/replenish.php', ['expenses' => $result, 'users' => $users]);
    }

    /**
     * Вывод истории баланса
     * 
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

    /** 
     * Пополнение счёта(оболочка)
     * 
     * @return void
     * @throws /Exception
     */
    public function replenish()
    {
        $this->dataPreparation($_POST['balance'], '+', 1);
    }

    /** 
     * Изменение счёта
     * 
     * @param int $sum 
     * @param '+' or '-' $action 
     * @param int(1-3) $type_operation 
     * @return void
     * @throws /Exception
     */
    public function dataPreparation($sum, $action, $type_operation)
    {
        $expense = $this->get();
        //TODO: Адаптировать методы dataPreparation и storeToHistory для использования извне

        $userId = $expense->user_id;
        $id = $expense->id;
        $data = $this->changeBalance($action, $sum);

        $all = $this->dataBuilder($_POST, ['balance' => $data, 'user_id' => $userId]);
        $args = ['balance' => $all['balance'], 'updated_at' => $all['updated_at'], 'user_id' => $all['user_id'], 'id' => $all['id']];

        if($this->checkSum($sum)){
            $this->storeToHistory($type_operation);
            $this->update($args, $id);
            $this->index();
        }
    }

    /**
     * Добавление данных в таблицу истории баланса
     *
     * @return void
     */
    public function storeToHistory($type_operation_id)
    {
        $expense = $this->get();

        $balance = $expense->balance;
        $date = date('Y-m-d H:i:s', time());
        $id = $expense->id;

        $all = $this->dataBuilder($_POST, ['status' => 1, 'date_of_enrollment' => $date, 'expense_id' => $id]);
        $args = ['balance' => $all['balance'], 'status' => $all['status'], 'date_of_enrollment' => $all['date_of_enrollment'], 'expense_id' => $all['expense_id'], 'created_at' => $all['created_at'], 'updated_at' => $all['updated_at'], 'type_operation_id' => $type_operation_id];

        $history = new HistoryExpenseModel();
        $history->store($args);
    }

    /**
     * Проверка данных введённых в форму
     * @return bool
     * @param int $sum
     */
    public function checkSum($sum)
    {
        if(!is_null($sum)){
            if(is_numeric($sum)){
                if((int)$sum <= $this->max_sum && (int)$sum >= $this->min_sum)
                {
                    return true;
                }
            } 
        } return false;
    }

    /**
     * Проверка user_id
     * @return bool
     */
    public function checkUser($userId)
    {
        if(!is_null($userId)){
            return true;
        } return false;
    }

    /**
     * Обновление данных таблицы
     *
     * @param $args
     * @param int $id
     * @return void
     */
    public function update($args, $id)
    {
        $expense = new ExpenseModel();
        $expense->update($id, $args);
    }

    /**
     * Удаление данных из таблицы
     * 
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $expense = new ExpenseModel;
        $expense->delete($id);
    }
}
