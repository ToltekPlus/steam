<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Model\GameModel;
use App\Policy\CompanyPolicy;
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
        $args = $this->dataBuilder($_POST, ['logotype_company' => $logotype, 'visibility' => 1]);

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
     * Меняем видимость для компании
     *
     * @return void
     */
    public function visibility()
    {
        $company = new CompanyModel();
        $company_visibility = $company->find($_GET['id']);

        $visibility = ["visibility" => (int)!$company_visibility->visibility];

        $args = $this->dataBuilder($visibility);
        $company->update($args, $_GET['id']);

        $this->visibilityGame($_GET['id'], $visibility);

        header('Location: /companies/list');
    }

    /**
     * Меняем отображение для игр компании
     *
     * @param $company
     * @param $visibility
     * @return void
     */
    public function visibilityGame($company, $visibility)
    {
        $games = new GameModel();
        $games = $games->findByCompany($company);

        foreach ($games as $game) {
            $game_visibility = new GameModel();
            $args = $this->dataBuilder($visibility);

            $game_visibility->update($args, $game->id);
        }
    }

    /**
     * Удаление компании и изображения из таблицы
     */
    // TODO дописать удаление игр вместе с компаниями
    public function delete() : void
    {
        /*
        $this->deleteImageFromDirectory($_POST['id']);

        $company = new CompanyModel();
        $company->delete($_POST['id']);*/
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
