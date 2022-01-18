<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Policy\CompanyPolicy;
use App\Rule\ControllerInterface;
use App\Service\UploadFile;
use Core\View;

class CompanyController extends CompanyPolicy implements ControllerInterface {
    use UploadFile;

    protected $logotype_path = '/resources/images/administrator/companies/';

    /**
     * @throws \Exception
     */
    public function index()
    {
        $companies = new CompanyModel();
        $result = $companies->all();

        View::render('administrator/companies/index.php', ['companies' => $result]);
    }

    public function get()
    {
        // TODO реализовать выборку данных для редактирования
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function show()
    {
        $companies = new CompanyModel();
        $count = $companies->count();

        View::render('administrator/companies/show.php', ['count' => $count]);
    }

    /**
     * @return void
     */
    public function store() {
        // TODO использовать js в обработчике
        $logotype = $this->upload($_FILES['logotype'], $this->logotype_path);

        $args = [
            'name_company' => $_POST['name_company'],
            'description_company' => $_POST['description_company'],
            'logotype_company' => $logotype,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ];

        $company = new CompanyModel();
        $company->store($args);
    }

    public function edit() {

    }
    public function update() {

    }
    public function delete() {

    }
}