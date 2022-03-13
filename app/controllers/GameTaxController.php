<?php

namespace App\Controller;

use App\Model\TaxGameModel;
use App\Policy\TaxGamePolicy;
use App\Service\DataBuilder;
use DateTime;
use Core\View;

class GameTaxController extends TaxGamePolicy {
    use DataBuilder;

    /**
     * @return void
     * @throws \Exception
     */
    public function create()
    {
        $game = new TaxGameModel();
        $game = $game->find($_GET['id']);

        // переформатируем дату в формат Y-m-d для инпута
        $createDate = new DateTime($game->end_of_discount);
        $strip = $createDate->format('Y-m-d');

        $game->end_of_discount = $strip;

        View::render('administrator/taxes_game/create.php', ['game' => $game]);
    }

    /**
     * @return void
     */
    public function store()
    {
        $args = $this->dataBuilder($_POST);

        $genre = new TaxGameModel();
        $genre->store($args);
    }

    /**
     * @return void
     */
    public function update()
    {
        $args = $this->dataBuilder($_POST);

        $tax = new TaxGameModel();
        $tax->update($args, $_POST['id']);
    }
}