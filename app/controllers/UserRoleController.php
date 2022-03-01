<?php

namespace App\Controller;

use App\Model\UserRoleModel;
use App\Policy\UserRolePolicy;
use App\Rule\ControllerInterface;
use Core\View;

class UserRoleController extends UserRolePolicy implements ControllerInterface {
    /**
     * UserRoleController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        $users = UserRoleModel::all();

        View::render('administrator/roles/index.php', ['users' => $users]);
    }

    /**
     * @throws \Exception
     */
    public function get($id) : object
    {
        $user_role = new UserRoleModel();
        return $user_role->find($id);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function show()
    {
        $user = $this->get($_GET['id']);

        View::render('administrator/roles/role.php', ['item' => $user]);
    }

    public function edit()
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}