<?php

namespace App\Controller;

use App\Model\RegisterModel;
use App\Service\DataBuilder;
use Core\View;

class RegisterController{

    use DataBuilder;

    public function store() : void {
        $_POST['phone']
        $_POST['password'] = md5($_POST['password']);
        $args = $this->dataBuilder($_POST);
        var_dump($_POST['phone']);

        $new_user = new RegisterModel();
        $new_user->store($args);
    }

}