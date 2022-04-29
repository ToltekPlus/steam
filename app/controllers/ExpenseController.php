<?php

namespace App\Controller;

use App\Model\ExpenseModel;
use App\Policy\ExpensePolicy;
use Core\View;
use App\Service\DataBuilder;
use App\Model\HistoryExpenseModel;
use App\Model\AccountModel;
use App\Model\UserRoleModel;

class ExpenseController extends ExpensePolicy{
    use DataBuilder;

    /**
     * Максимальная сумма пополнения
     * 
     * @var integer
     */
    private $max_balance = 5000;

    /**
     * Минимальная сумма пополнения
     * 
     * @var integer
     */
    private $min_balance = 100;

    /**
     * Вывод главной страницы баланса
     * 
     * @throws /Exception
     */
    public function index()
    {
        $expense = new ExpenseModel();
        $accounts = new AccountModel();
        $roles = new UserRoleModel();

        $role = $roles->getByAuthId();
        $users = $expense->getUsers();

        if(!is_null($_POST['user'])){ 
            $result = $expense->findUserBalance($_POST['user']);
            $account = $accounts->getFullName($_POST['user']);
        } else {
            if(!is_null($_GET['id'])){
                $result = $expense->findUserBalance($_GET['id']);
                $account = $accounts->getFullName($_GET['id']);
            } else {
                $result = $expense->findUserBalance($_SESSION['sid']);
                $account = $accounts->getFullName($_SESSION['sid']);
            } 
        }
        
        View::render('expenses/index.php', ['expenses' => $result, 'users' => $users, 'account' => $account, 'role' => $role]);
    }

    /**
     * Вывод окна подтверждения
     * 
     * @return void
     * @throws \Exception
     */
    public function confirm()
    {
        if($this->checkBalance($_POST['balance'])){
            View::render('expenses/confirm.php', ['balance' => $_POST['balance']]);
        } else {
            View::render('errors/400.php');
        }
    }

    /**
     * Получение баланса
     * 
     * @param int $user_id
     * @return array
     */
    public function get($user_id)
    {
        $expense = new ExpenseModel();
        return $expense->findUserBalance($user_id)[0];
    }

    /**
     * Изменение баланса для снятия или пополнения
     * 
     * @param '+' or '-' $action 
     * @throws \Exception
     */
    public function changeBalance($action, $balance, $user_id)
    {
        $expense = $this->get($user_id)->balance;

        switch ($action) {
            case '+':
                return $expense + $balance;
                break;

            case '-':
                return $expense - $balance;
                break;

            default:
                return $expense;
                break;
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

        View::render('expenses/replenish.php', ['expenses' => $result, 'users' => $users]);
    }

    /**
     * Вывод истории баланса
     * 
     * @throws /Exception
     */
    public function showHistory()
    {
        $history = new HistoryExpenseModel();
        $roles = new UserRoleModel();
        $expense = new ExpenseModel();

        $role = $roles->getByAuthId();
        $result = array_slice($history->all(), 0, 50, true);
        $expenses = $expense->all();

        foreach($result as $history):
            switch ($history->status) {
                case '1':
                    $history->status = 'Выполнено';
                    break;
                case '0':
                    $history->status = 'Невыполнено';
                    break;
            };

            switch($history->type_operation_id){
                case '1':
                    $history->type_operation_id = 'Пополнение';
                    break;

                case '2':
                    $history->type_operation_id = 'Оплата';
                    break;

                case '3':
                    $history->type_operation_id = 'Возврат средств';
                    break;

                }
        endforeach;

        View::render('expenses/history.php', ['histories' => $result, 'expenses' => $expenses, 'role' => $role]);
    }

    /** 
     * Пополнение счёта(оболочка)
     * 
     * @return void
     * @throws /Exception
     */
    public function replenish()
    {
        $this->dataPreparation($_POST['balance'], '+', 1, $_POST['user']);
        $this->index();
    }

    /** 
     * Изменение счёта
     * 
     * @param int $balance 
     * @param '+' or '-' $action 
     * @param int(1-3) $type_operation 
     * @param int $user_id 
     * @return void
     * @throws /Exception
     */
    public function dataPreparation($balance, $action, $type_operation_id, $user_id)
    {
        (is_null($user_id)) ? $user_id = $_SESSION['sid'] : $user_id = $user_id;
        $expense = $this->get($user_id);

        $data = $this->changeBalance($action, $balance, $user_id); 
        $expense_id = $expense->id; 

        $all = $this->dataBuilder($_POST, ['id' => $expense_id, 'balance' => $data, 'user_id' => $user_id]);
        $args = ['balance' => $all['balance'], 'updated_at' => $all['updated_at'], 'user_id' => $all['user_id'], 'id' => $all['id']];

        $this->storeToHistory($type_operation_id, $user_id, $balance);
        $this->update($args, $all['id']);
    }

    /**
     * Добавление данных в таблицу истории баланса
     *
     * @return void
     */
    public function storeToHistory($type_operation_id, $user_id, $balance)
    {
        $expense = $this->get($user_id);

        $date = date('Y-m-d H:i:s', time());
        $id = $expense->id;

        $all = $this->dataBuilder($_POST, ['balance' => $balance, 'status' => 1, 'date_of_enrollment' => $date, 'expense_id' => $id]);
        $args = ['balance' => $all['balance'], 'status' => $all['status'], 'date_of_enrollment' => $all['date_of_enrollment'], 'expense_id' => $all['expense_id'], 'created_at' => $all['created_at'], 'updated_at' => $all['updated_at'], 'type_operation_id' => $type_operation_id];

        $history = new HistoryExpenseModel();
        $history->store($args);
    }

    /**
     * Проверка данных введённых в форму
     * @return bool
     * @param int $balance
     */
    public function checkBalance($balance)
    {
        if(!is_null($balance)){
            if(is_numeric($balance)){
                if((int)$balance <= $this->max_balance && (int)$balance >= $this->min_balance)
                {
                    return true;
                }
            } 
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
