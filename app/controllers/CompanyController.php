<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Policy\CompanyPolicy;
use App\Rule\ControllerInterface;
use Core\View;

class CompanyController extends CompanyPolicy implements ControllerInterface {
    /**
     * @throws \Exception
     */
    public function index()
    {
        $companies = new CompanyModel();
        $result = $companies->all();

        View::render('administrator/companies/index.php', ['companies' => $result]);
    }

    public function get() {

    }

    public function show()
    {

    }

    public function store() {

    }

    public function edit() {

    }
    public function update() {

    }
    public function delete() {

    }
}