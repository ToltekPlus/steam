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
    public function get(){

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

    public function edit(){

    }
    public function update(){

    }
    public function delete(){

    }
}