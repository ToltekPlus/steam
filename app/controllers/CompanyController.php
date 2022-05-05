<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Policy\CompanyPolicy;
use App\Model\GameModel;
use App\Rule\ControllerInterface;
use App\Service\DataBuilder;
use App\Service\DeleteFile;
use App\Service\UploadFile;
use Core\View;

class CompanyController extends CompanyPolicy implements ControllerInterface {
    use UploadFile;
    use DeleteFile;
    use DataBuilder;

    protected $logotype_path = 'administrator/companies/';

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
    public function store() : void
    {
        $logotype = $this->upload($_FILES['logotype'], $this->logotype_path);
        $args = $this->dataBuilder($_POST, ['logotype_company' => $logotype]);

        $company = new CompanyModel();
        $company->store($args);
    }

    /**
     * @throws \Exception
     */
    public function edit()
    {
        $company = $this->get($_GET['id']);

        View::render('administrator/companies/edit.php', ['company' => $company]);
    }

    /**
     * Обновление информации о компаниях
     */
    public function update()
    {
        if ($_FILES['logotype']['size'] != 0) {
            $this->deleteImageFromDirectory($_POST['id']);
            $logotype = $this->upload($_FILES['logotype'], $this->logotype_path);
        }else {
            $company = $this->get($_POST['id']);
            $logotype = $company->logotype_company;
        }
  
        $args = $this->dataBuilder($_POST, ['logotype_company' => $logotype]);

        $company = new CompanyModel();
        $company->update($args, $_POST['id']);
    }

    /**
     * Удаление компании и изображения из таблицы
     */
    public function delete() : void
    {
        $this->deleteImageFromDirectory($_POST['id']);


        $games = new GameModel();

        $date = date('Y-m-d H:i:s', time());
        $args = ['company_id' => NULL, 'updated_at' => $date];
        $game_id = $games->findByCompany($_POST['id'])->id;
        var_dump($games->findByCompany($_POST['id']));

        $games->update($args, $game_id);

        $company = new CompanyModel();
        $company->delete($_POST['id']);
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