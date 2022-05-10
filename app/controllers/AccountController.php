<?php

namespace App\Controller;

use App\Model\AccountModel;
use App\Service\DataBuilder;
use App\Service\DeleteFile;
use App\Service\UploadFile;
use Core\View;

class AccountController {
    use UploadFile;
    use DeleteFile;
    use DataBuilder;

    protected $userpic_path = 'userpic/';

    /**
     * @return void
     */
    public function get($id) : object
    {
        $account = new AccountModel();
        return $account->find($id);
    }

    /**
     * @throws \Exception
     */
    public function edit()
    {
        $account = $this->get($_SESSION['sid']);

        View::render('account/edit.php', ['account' => $account]);
    }

    /**
     * Обновление информации аккаунта и юзерпика
     */
    public function update()
    {
        if ($_FILES['userpic']['size'] != 0) {
            // TODO при удалении может удалиться дефолтный юзерпик
            //$this->deleteImageFromDirectory($_SESSION['sid']);
            $userpic = $this->upload($_FILES['userpic'], $this->userpic_path);
        } else {
            $account = $this->get($_SESSION['sid']);
            $userpic = $account->userpic;
        }

        $args = $this->dataBuilder($_POST, ['userpic' => $userpic]);

        $account = new AccountModel();
        $account->update($args, $_POST['id']);
    }

    /**
     * Удаление пользовательского и установка дефолтного юзерпика
     */
    public function delete_userpic()
    {
        $data = [];
        foreach ($_POST as $key => $value)
        {
            $data = json_decode($key, true);
        }

        $userpic = "/userpic_default/userpic.jpg";

        $args = $this->dataBuilder($data, ['userpic' => $userpic]);

        $account = new AccountModel();
        $account->update($args, $data['id']);
    }

    /**
     * @param $id
     */
    public function deleteImageFromDirectory($id)
    {
        $account = $this->get($id);
        $this->deleteImage($account->userpic);
    }
}