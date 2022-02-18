<?php

namespace App\Controller;

class RegController
    public function reg()
    {
        $_SESSION['sid'] = 1;
        header('Location: /');
    }