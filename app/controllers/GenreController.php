<?php

namespace App\Controller;

use App\Model\GenreModel;
use App\Policy\GenrePolicy;
use App\Rule\ControllerInterface;
use App\Service\DataBuilder;
use App\Service\DeleteFile;
use App\Service\UploadFile;
use Core\View;

class GenreController extends GenrePolicy implements ControllerInterface {
    use UploadFile;
    use DeleteFile;
    use DataBuilder;

    protected $icon_path = '/administrator/genres/';

    /**
     * @throws \Exception
     */
    public function index() : void
    {
        $genres = new GenreModel();
        $result = $genres->all();

        View::render('administrator/genres/index.php', ['genres' => $result]);
    }

    /**
     * @param $id
     * @return object
     */
    public function get($id) : object
    {
        $genre = new GenreModel();
        return $genre->find($id);
    }

    /**
     * @throws \Exception
     */
    public function show() : void
    {
        View::render('administrator/genres/show.php');
    }

    /**
     * Добавление нового жанра
     */
    public function store() : void
    {
        $icon = $this->upload($_FILES['icon'], $this->icon_path);
        $args = $this->dataBuilder($_POST, ['icon_genre' => $icon]);

        $genre = new GenreModel();
        $genre->store($args);
    }

    /**
     * @throws \Exception
     */
    public function edit() : void
    {
        $genre = $this->get($_GET['id']);

        View::render('administrator/genres/edit.php', ['genre' => $genre]);
    }

    /**
     * Обновление информации о жанрах
     */
    public function update() : void
    {
        // TODO реализовать проверку наличия изображения
        $icon = $this->upload($_FILES['icon'], $this->icon_path);
        $args = $this->dataBuilder($_POST, ['icon_genre' => $icon]);

        $genre = new GenreModel();
        $genre->update($args, $_POST['id']);
    }

    /**
     * Удаление жанра и изображения из таблицы
     */
    public function delete() : void
    {
        $this->deleteImageFromDirectory($_POST['id']);

        $genre = new GenreModel();
        $genre->delete($_POST['id']);
    }

    /**
     * @param $id
     */
    public function deleteImageFromDirectory($id)
    {
        $genre = $this->get($id);
        $this->deleteImage($genre->icon_genre);
    }
}