<?php

namespace App\Policy;

use App\Model\UserRoleModel;
use Core\View;

class HomePolicy {
    protected $role;

    /**
     * HomePolicy constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $role = new UserRoleModel();
        $this->role = $role->getByAuthId();

        if ((int)$this->role === 2) {
            return true;
        }else {
            die(View::render('errors/403.php'));
        }
    }
}