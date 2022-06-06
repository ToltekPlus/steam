<?php

namespace App\Controller;

use App\Model\GameModel;
use App\Model\ImageGameModel;
use App\Service\DataBuilder;
use App\Service\DeleteFile;
use App\Service\UploadFile;
use Core\View;

class ImageGameController {
    use UploadFile;
    use DataBuilder;
    use DeleteFile;

    /**
     * @var string
     */
    protected $image_path = 'administrator/images_for_game/';

    /**
     * @param $id
     * @return object
     */
    public function get($id) : object
    {
        $image = new ImageGameModel();
        return $image->findForDelete($id);
    }

    /**
     * @throws \Exception
     */
    public function index()
    {
        $images = new ImageGameModel();
        $images = $images->find($_GET['id']);

        $game = new GameModel();
        $game = $game->find($_GET['id'])->id;

        View::render('administrator/images_for_games/index.php', ['game_id' => $game, 'images' => $images]);
    }

    /**
     * Добавление изображения в DB
     */
    public function store() : void
    {
        $image = $this->upload($_FILES['image'], $this->image_path);
        $args = $this->dataBuilder($_POST, ['path' => $image]);

        $img_game = new ImageGameModel();
        $img_game->store($args);
    }

    /**
     * Удаление изображения из DB
     */
    public function delete() : void
    {
        $this->deleteImageFromDirectory($_GET['id']);

        $image = new ImageGameModel();
        $image->delete($_GET['id']);

        header('Location:  /games/list');
    }

    /**
     * @param $id
     */
    public function deleteImageFromDirectory($id)
    {
        $image = $this->get($id);
        $this->deleteImage($image->path);
    }
}
