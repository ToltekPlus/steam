<?php

namespace App\Controller;

use App\Model\OrderModel;
use App\Service\DeleteFile;
use App\Service\DataBuilder;
use Core\View;

class LibraryController {
    use DeleteFile;
    use DataBuilder;
    /**
     * @var
     */
    public $libraryKeys;

    /**
     * @return void
     */
    public function index()
    {
        $allGames = OrderModel::allGamesForUser();

        $myGames = [];
        foreach ($allGames as $key => $games) {
            if ($games->user_id == $_SESSION['sid']) {
                array_push($myGames, $games);
            }
        }

        View::render('orders/index.php', ['myGames' => $myGames]);
    }
    public function show()
    {
        $library = new OrderModel();
        $count = $library->count();

        View::render('orders/index.php', ['count' => $count]);
    }


        public function store() : void
    {
        $logotype = $this->upload($_FILES['logotype'], $this->logotype_path);
        $args = $this->dataBuilder($_POST, ['logotype_games' => $logotype]);

        $library = new OrdersModel();
        $library->store($args);
        }

    /**
     * @param $id
     * @return object
     */
    public function get($id)
    {
        $library = new OrdersModel();
        return $library->find($id);
    }

    public function delete() : void
    {
        $this->deleteImageFromDirectory($_POST['id']);

        $Games = new OrderModel();
        $Games->delete($_POST['id']);
    }

}

?>

