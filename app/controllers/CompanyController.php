<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Policy\CompanyPolicy;
use App\Rule\ControllerInterface;
use App\Service\DataBuilder;
use App\Service\UploadFile;
use Core\View;

class CompanyController extends CompanyPolicy implements ControllerInterface {
    use UploadFile;
    use DataBuilder;
    protected $logotype_path = '/resources/images/administrator/companies/';

    /**
     * @throws \Exception
     */
    public function index()
    {
        $company = new CompanyModel();
        $result = $company->all();

        View::render('administrator/companies/index.php', ['companies' => $result]);
    }

    /**
     * @return void
     */
    public function get($id) : object
    {
        // TODO реализовать выборку данных для редактирования
        $company = new CompanyModel();
        return $company->find($id);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function show()
    {
        $company = new CompanyModel();
        $count = $company->count();

        View::render('administrator/companies/show.php', ['count' => $count]);
    }

    /**
     * @return void
     */
    public function store() : void {
        $logotype = $this->upload($_FILES['logotype'], $this->logotype_path);
        $args = $this->dataBuilder($_POST, ['logotype_company' => $logotype]);

        $company = new CompanyModel();
        $company->store($args);
    }

    /**
     * @throws \Exception
     */
    public function edit() {
        $company = $this->get($_GET['id']);

        View::render('administrator/companies/edit.php', ['company' => $company]);
    }
    /**
     * Обновление информации о компаниях
     */
    public function update() {
        // TODO реализовать проверку наличия изображения
        $logotype = $this->upload($_FILES['logotype'], $this->logotype_path);
        $args = $this->dataBuilder($_POST, ['logotype_company' => $logotype]);

        $company = new CompanyModel();
        $company->update($args, $_POST['id']);

    }
    /**
     * Удаление компании и изображения из таблицы
     */
    public function delete() : void
    {
        $this->deleteImageFromDirectory($_GET['id']);

        $company = new CompanyModel();
        $company->delete($_GET['id']);
    }

    /**
     * @param $id
     */
    public function deleteImageFromDirectory($id)
    {
        $company = $this->get($id);
        $this->deleteImage($company->logotype_company);
    }
}