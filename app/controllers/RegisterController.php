<?php

namespace App\Controller;

use App\Model\AccountModel;
use App\Model\RegisterModel;
use App\Model\UserRoleModel;
use App\Service\DataBuilder;
use App\Model\ExpenseModel;

class RegisterController{
    use DataBuilder;

    /**
     * @return void
     */
    public function store() : void
    {
        $register_data = $this->dataPreparation($_POST);

        $args = $this->dataBuilder($register_data);

        $new_user = new RegisterModel();
        $new_user_id = $new_user->store($args);

        $this->auth($new_user_id);

        $this->addUserRole($new_user_id);

        $this->addAccount($new_user_id);

        $date = date('Y-m-d H:i:s', time());
        $argsExpense = ['balance' => 0, 'created_at' => $date, 'updated_at' => $date, 'user_id' => $new_user_id];

        $expense = new ExpenseModel();
        $expense->store($argsExpense);

        echo $new_user_id;
    }

    /**
     * @param $data
     * @return array
     */
    public function dataPreparation($data)
    {
        $register_data = [];
        foreach ($data as $key => $value)
        {
            $json_decode_data = json_decode($key, true);
            $register_data['phone'] = $json_decode_data['phone'];
            $register_data['password'] = md5($json_decode_data['password']);
        }

        return $register_data;
    }

    /**
     * @param $id
     * @return void
     */
    public function auth($id)
    {
        $user = new LoginController();
        $user->authNewUser($id);
    }

    /**
     * @param $user_id
     * @return void
     */
    public function addUserRole($user_id)
    {
        $data = [
            'user_id' => $user_id,
            'role_id' => 1
        ];

        $args = $this->dataBuilder($data);

        $role_user = new UserRoleModel();
        $role_user->store($args);
    }

    /**
     * @param $user_id
     * @return void
     */
    public function addAccount($user_id)
    {
        $data = [
            'user_id' => $user_id,
            'name' => 'Duke',
            'surname' => 'Nukem',
            'about' => '',
            'userpic' => '/userpic/userpic.jpg',
            'birthday_at' => date('Y-m-d H:i:s')
        ];

        $args = $this->dataBuilder($data);

        $account = new AccountModel();
        $account->store($args);
    }
}
