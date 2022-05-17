<?php

namespace App\Controller;

use App\Model\AccountModel;
use App\Model\GameModel;
use App\Model\GenreModel;
use App\Model\CompanyModel;
use App\Model\TaxGameModel;
use App\Model\UserRoleModel;
use App\Policy\HomePolicy;
use Core\View;

class HomeController extends HomePolicy
{
    /**
     * @var
     */
    protected $selector;

    /**
     * @var int
     */
    protected $base_selector = 20;

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

        $games = TaxGameModel::summaryInformation($this->base_selector);

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

    /**
     * account userpic
     */
    static function accountUserpic()
    {
        $account = new AccountModel();
        $account = $account->find($_SESSION['sid']);

        echo $account->userpic;
    }

    /**
     * Пишет имя и фамилию аккаунта юзера
     */
    static function accountData() {
        $account = new AccountModel();
        $account = $account->find($_SESSION['sid']);

        $data = $account->name . " " . $account->surname;

        echo $data;
    }

    /**
     * @return mixed
     */
    static function accountRole()
    {
        /*
         * Неактуально, т.к. в сессию теперь записываем уровень доступа
        $role = new UserRoleModel();
        $role = $role->find($_SESSION['sid_role']);

        return $role->role_id;
        */

        return $_SESSION['sid_role'];
    }

    /**
     * Переопределяем игры по количеству
     */
    public function selectorGames()
    {
        foreach ($_POST as $key => $item) {
            $this->selector = $key;
        }

        $games = TaxGameModel::summaryInformation($this->selector);

        $addOtherInformationForGames = $this->addOtherInformation($games);

        // сортируем только игры, которые можно отображать
        $sortGames = array_filter($addOtherInformationForGames, function ($key) use ($games) {
            return $games[$key]->visibility;
        }, ARRAY_FILTER_USE_KEY);

        echo json_encode($sortGames);
    }

    /**
     * @return void
     */
    public function selectorGenres()
    {
        foreach ($_POST as $key => $item) {
            $this->selector = $key;
        }

        $games = new GameModel();
        $games = $games->findByGenre($this->selector);

        $taxGames = $this->selectTaxGames($games);

        // сортируем только игры, которые можно отображать
        $sortGames = array_filter($taxGames, function ($key) use ($games) {
            return $games[$key]->visibility;
        }, ARRAY_FILTER_USE_KEY);

        echo json_encode($sortGames);
    }

    public function selectorCompanies()
    {
        foreach ($_POST as $key => $item) {
            $this->selector = $key;
        }

        $games = new GameModel();
        $games = $games->findByCompany($this->selector);

        $taxGames = $this->selectTaxGames($games);

        // сортируем только игры, которые можно отображать
        $sortGames = array_filter($taxGames, function ($key) use ($games) {
            return $games[$key]->visibility;
        }, ARRAY_FILTER_USE_KEY);

        echo json_encode($sortGames);
    }

    /**
     * @param $games
     * @return array
     */
    public function selectTaxGames($games)
    {
        $result = [];
        foreach ($games as $key => $game) {
            $taxGame = new TaxGameModel();
            $taxGame = $taxGame->find($game->id);
            $result[$key] = $taxGame;
            $result[$key] = $games[$key];

            $genre = new GenreModel();
            $genre = $genre->find($games[$key]->genre_id);
            $result[$key]->genre = $genre;

            $company = new CompanyModel();
            $company = $company->find($games[$key]->company_id);
            $result[$key]->company = $company;
        }

        return $result;
    }
}
