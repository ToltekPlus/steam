<?php

namespace App\Controller;

use App\Model\CompanyModel;
use App\Model\GameModel;
use App\Model\GenreModel;
use App\Model\TaxGameModel;
use App\Rule\ControllerInterface;
use App\Service\DataBuilder;
use App\Service\DeleteFile;
use App\Service\UploadFile;
use Core\View;

class GameController implements ControllerInterface {
    use UploadFile;
    use DeleteFile;
    use DataBuilder;

    protected $cover_path = 'administrator/games/';

    /**
     * @return void
     * @throws \Exception
     */
    public function index()
    {
        $games = new GameModel();
        $result = $games->all();

        View::render('administrator/games/index.php', ['games' => $result]);
    }

    /**
     * Получаем список игр для поиска
     */
    public function all()
    {
        $games = new GameModel();
        $games = $games->all();

        $result = $this->toObject($games);

        echo json_encode($result);
    }

    /**
     * @param $games
     * @return array
     */
    protected function toObject($games)
    {
        $result = [];
        foreach ($games as $k => $game) {
            $result[$k]['game_id'] = $game->id;
            $result[$k]['game_name'] = $game->name_game;
        }

        return $result;
    }

    /**
     * @param $id
     * @return object
     */
    public function get($id)
    {
        $game = new GameModel();
        return $game->find($id);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function show()
    {
        $genres = new GenreModel();
        $genres = $genres->all();

        $companies = new CompanyModel();
        $companies = $companies->all();

        View::render('administrator/games/show.php', ['genres' => $genres, 'companies' => $companies]);
    }


    /**
     * @return void
     */
    public function store()
    {
        $cover_game = $this->upload($_FILES['cover_game'], $this->cover_path);
        $args = $this->dataBuilder($_POST, ['cover_game' => $cover_game]);

        $game = new GameModel();
        $key = $game->store($args);

        // ставим по умолчанию скидку на год вперед равную нулю
        $end_of_discount = date('Y-m-d', strtotime('+1 year'));

        $argsTax = $this->dataBuilder(['tax' => 0, 'game_id' => (int) $key, 'end_of_discount' => $end_of_discount]);

        $tax = new TaxGameModel();
        $tax->store($argsTax);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function edit()
    {
        $game = $this->get($_GET['id']);

        $genres = new GenreModel();
        $genres = $genres->all();

        $companies = new CompanyModel();
        $companies = $companies->all();

        View::render('administrator/games/edit.php', ['game' => $game, 'genres' => $genres, 'companies' => $companies]);
    }

    /**
     * @return void
     */
    public function visibility()
    {
        $game = $this->get($_GET['id']);
        $visibility = (int)!$game->visibility;

        $args = $this->dataBuilder(['visibility' => $visibility]);

        $game = new GameModel();
        $game->update($args, $_GET['id']);

        header('Location: ' . '/games/list');
    }

    /**
     * @return void
     */
    // TODO правильное сокрытие игры: если компания скрыта, то запретить отображение игры в любом случае
    public function update()
    {
        if ($_FILES['cover_game']['size'] != 0) {
            $this->deleteImageFromDirectory($_POST['id']);
            $cover_game = $this->upload($_FILES['cover_game'], $this->cover_path);
        }else {
            $game = $this->get($_POST['id']);
            $cover_game = $game->cover_game;
        }

        $args = $this->dataBuilder($_POST, ['cover_game' => $cover_game]);

        $game = new GameModel();
        $game->update($args, $_POST['id']);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteImageFromDirectory($id)
    {
        $game = $this->get($id);
        $this->deleteImage($game->cover_game);
    }

    /**
     * @throws \Exception
     */
    public function showGame()
    {
        $game = GameModel::summaryInformation($_GET['id']);

        $tax = new TaxGameModel();
        $tax = $tax->find($_GET['id']);

        View::render('games/index.php', ["game" => $game, "tax" => $tax]);
    }
}
