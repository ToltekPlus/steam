<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Policy\ResetPasswordPolicy;
use App\Service\DataBuilder;
use Core\View;

class ResetPasswordController extends ResetPasswordPolicy{
    use DataBuilder;

    /**
     * запись сгенерированного пароля в БД
     */
    public function changePassword()
    {
        $user_data = $this->get($_GET['id']);
        $data = (array) $user_data;

        $password = $this->generatePassword();
        $data['password'] = md5($password);
        $args = $this->dataBuilder($data);

        $user = new UserModel();
        $user->update($args, $_GET['id']);

        $password_obj = (object) array('password' => $password);
        View::render('administrator/users/change_password_result.php', ['user' => $password_obj]);
    }

    /**
     * генерация нового пароля
     * @return [type] [description]
     */
    public function generatePassword()
    {
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max = 8;
        $size = StrLen($chars) - 1;
        $password = null;
        while($max--) $password .= $chars[rand(0,$size)];

        return $password;
    }

    /**
     * @return void
     */
    public function get($id) : object
    {
        $user = new UserModel();
        return $user->find($id);
    }
}