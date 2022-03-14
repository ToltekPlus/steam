<?php

namespace App\Controller;

use App\Model\GameModel;
use App\Model\GenreModel;
use App\Model\CompanyModel;
use App\Model\TaxGameModel;
use App\Policy\HomePolicy;
use Core\View;

class HomeController extends HomePolicy
{
    public function __construct()
    {
        //parent::__construct();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function index() : void
    {
        $genres = new GenreModel();
        $genres = $genres->all();

        $companies = new CompanyModel();
        $companies = $companies->all();

        $games = TaxGameModel::summaryInformation();

        $addOtherInformationForGames = $this->addOtherInformation($games);

        // сортируем только игры, которые можно отображать
        $sortGames = array_filter($addOtherInformationForGames, function ($key) use ($games) {
            return $games[$key]->visibility;
        }, ARRAY_FILTER_USE_KEY);

        View::render('dashboard/index.php', ['games' => $sortGames, 'genres' => $genres, 'companies' => $companies]);
    }

    /**
     * @param $games
     * @return array
     */
    public function addOtherInformation($games)
    {
        $result = [];
        foreach ($games as $key => $game) {
            $result[$key] = $game;

            $genre = new GenreModel();
            $genre = $genre->find($game->genre_id);
            $result[$key]->genre = $genre;

            $company = new CompanyModel();
            $company = $company->find($game->company_id);
            $result[$key]->company = $company;
        }

        return $result;
    }

    static function account()
    {
        // TODO вывод информации о пользователе для вывода в хедер
    }
}