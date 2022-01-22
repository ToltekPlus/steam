<?php

namespace App\Controller;

use App\Model\GenreModel;
use App\Policy\GenrePolicy;
use App\Rule\ControllerInterface;
use App\Service\UploadFile;
use Core\View;

class GenreController extends GenrePolicy implements ControllerInterface {
    use UploadFile;

    protected $icon_path = '/resources/images/administrator/genres/';

    /**
     * @throws \Exception
     */
    public function index()
    {
        $genres = new GenreModel();
        $result = $genres->all();

        View::render('administrator/genres/index.php', ['genres' => $result]);
    }

    /**
     * @return array
     */
    public function get()
    {
        $genre = new GenreModel();
        return $genre->find($_GET['id']);
    }

    /**
     * @throws \Exception
     */
    public function show(){
        View::render('administrator/genres/show.php');
    }

    /**
     * Добавление нового жанра
     */
    public function store()
    {
        $icon = $this->upload($_FILES['icon'], $this->icon_path);

        $args = [
            'name_genre' => $_POST['name_genre'],
            'icon_genre' => $icon,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ];

        $genre = new GenreModel();
        $genre->store($args);
    }

    /**
     * @throws \Exception
     */
    public function edit()
    {
        $genre = $this->get();

        View::render('administrator/genres/edit.php', ['genre' => $genre]);
    }

    /**
     * Обновление информации о жанрах
     */
    public function update()
    {
        // TODO реализовать проверку наличия изображения
        $icon = $this->upload($_FILES['icon'], $this->icon_path);

        $args = [
            'name_genre' => $_POST['name_genre'],
            'icon_genre' => $icon,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ];

        $genre = new GenreModel();
        $genre->update($args, $_POST['id']);
    }

    public function delete(){

    }
}