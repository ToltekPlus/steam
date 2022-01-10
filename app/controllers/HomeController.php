<?php

namespace App\Controller;

use App\Model\UserRoleModel;
use Core\View;

class HomeController
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        $roles = UserRoleModel::all();

        View::render('index/index.php', ['roles' => $roles]);
    }
}