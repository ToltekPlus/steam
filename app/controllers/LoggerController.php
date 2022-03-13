<?php

namespace App\Controller;

use App\Policy\LoggerPolicy;
use Core\Logger;
use Core\View;

class LoggerController extends LoggerPolicy {
    /**
     * @throws \Exception
     */
    public function index()
    {
        $handle = $this->reverseFile();

        if ($handle) {
            View::render('administrator/logs/show.php', ['logs' => $handle]);
        }else {
            die(View::render('errors/404.php'));
        }
    }

    /**
     * переворачиваем файл для отображения более новых ошибок
     *
     * @return array
     */
    public function reverseFile()
    {
        $file_array = array();

        $handle = fopen(dirname(__DIR__, 2) .$_ENV['LOGGER_PATH'] . 'root.log', 'r');
        while (!feof($handle)) {
            $line = fgets($handle, 4096);
            array_unshift($file_array, $line);
        }
        fclose($handle);

        return $file_array;
    }
}