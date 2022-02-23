<?php

namespace App\Controller;

use App\Model\GenreModel;
use App\Model\CompanyModel;
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

        View::render('dashboard/index.php', ['genres' => $genres, 'companies' => $companies]);
    }

    static function account()
    {
        // TODO вывод информации о пользователе для вывода в хедер
    }
}