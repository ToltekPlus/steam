<?php

namespace App\Controller;

use App\Policy\LoggerPolicy;
use Core\Logger;
use Core\View;

class LoggerController extends LoggerPolicy {
    /**
     * @return void
     * @throws \Exception
     */
    public function index()
    {
        $handle = fopen(dirname(__DIR__, 2) .$_ENV['LOGGER_PATH'] . 'root.log' , "r");
        if ($handle) {
            View::render('administrator/logs/show.php', ['logs' => $handle]);

            fclose($handle);
        }else {
            die(View::render('errors/404.php'));
        }
    }
}