<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Model\UserRoleModel;

class LoginController {
    /**
     * Авторизация пользователя
     * @return false|void
     */
    public function auth()
    {
        $auth_data = $this->dataFormation($_POST);

        $user = new UserModel();
        $user_by_check_phone = $user->findByAuthData('phone', strval($auth_data['phone']));

        if ($user_by_check_phone) $result = $this->checkPassword($auth_data['password'], $user_by_check_phone->password);

        if (!$result) {
            echo 0;
            return false;
        }

        $user_role = new UserRoleModel();
        $user_role = $user_role->findByRole('user_id', $user_by_check_phone->id);
        $this->addSessionVariable($user_by_check_phone->id, array_shift($user_role)->role_id);

        echo 1;
    }

    /**
     * Проверка двух паролей на сходство
     * @param $password
     * @param $password_from_table
     * @return bool
     */
    public function checkPassword($password, $password_from_table)
    {
        if ($password != $password_from_table) return false;

        return true;
    }

    /**
     * @param $id
     * @return void
     */
    public function authNewUser($id)
    {
        $this->checkSession();
        $_SESSION['sid'] = (int)$id;
        $_SESSION['sid_role'] = 1;
    }

    /**
     * @param $id
     * @param $role
     * @return void
     */
    public function addSessionVariable($id, $role)
    {
        $this->checkSession();
        $_SESSION['sid'] = (int)$id;
        $_SESSION['sid_role'] = (int)$role;
    }

    /**
     * @return void
     */
    public function checkSession()
    {
        if ($_SESSION) session_destroy();
    }

    /**
     * @return mixed
     */
    public function getAuthId()
    {
        echo $_SESSION['sid'];
    }

    /**
     * Парсинг массива с данными(номер и пароль) в формате json
     * @param $data
     * @return array
     */
    public function dataFormation($data)
    {
        $auth_data = [];
        foreach ($data as $key => $value)
        {
            $json_decode_data = json_decode($key, true);
            $auth_data['phone'] = $json_decode_data['phone'];
            $auth_data['password'] = md5($json_decode_data['password']);
        }

        return $auth_data;
    }

    /**
     * Выход их аккаунта
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
