<?php

namespace App\Controller;

use App\Model\UserRoleModel;
use App\Policy\HomePolicy;
use Core\View;

class HomeController extends HomePolicy
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        $roles = UserRoleModel::all();

        View::render('dashboard/index.php', ['roles' => $roles]);
    }
}