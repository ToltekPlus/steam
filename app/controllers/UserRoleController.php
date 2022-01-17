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

        View::render('administrator/roles/show.php', ['users' => $users]);
    }

    /**
     * @throws \Exception
     */
    public function get()
    {
        // TODO реализовать более удобный вывод одной записи
        $user = UserRoleModel::find($_GET['id'])[0];

        View::render('administrator/roles/index.php', ['user' => $user]);
    }

    public function show()
    {
        // TODO: Implement show() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function store()
    {
        // TODO: Implement store() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}