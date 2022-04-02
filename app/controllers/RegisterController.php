<?php

namespace App\Controller;

use App\Model\RegisterModel;
use App\Service\DataBuilder;
use Core\View;

class RegisterController{

    use DataBuilder;

    /**
     * Добавление номера и пароля в базу(создание нового пользователя)
     */
    public function store() : void {

        foreach ($_POST as $key => $value)
        {
            $json = json_decode($key, true);
            foreach ($json as $key => $value) {
                $array[$key] = $value;
            }
        }
        $chars = ['_', '+', '(', ')'];
        $array["phone"] = str_replace($chars, "", $array["phone"]);
        $array["password"] = md5($array["password"]);
        $args = $this->dataBuilder($array);

        $new_user = new RegisterModel();
        $new_user->store($args);
    }
}