<?php

namespace App\Controller;

class LoginController {
    /**
     * TODO авторизация
     */
    public function auth()
    {
        $_SESSION['sid'] = 1;
        header('Location: /');
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