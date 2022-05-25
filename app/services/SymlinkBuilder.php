<?php

namespace App\Service;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

trait SymlinkBuilder {
    protected $result = [];

    /**
     * @param $dir
     * @param $symlink
     * @return void
     */
    public function generateTree($dir, $symlink)
    {
        $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach($iter as $file) {
            if ($file->getFilename() == '.') {
                $this->formatDirectory($file);

                // если понадобится выводить полное дерево
                // echo $file->getPath() . PHP_EOL . "<br>";
            }
        }

        symlink($dir, $symlink . $this->result[1]);
    }

    /**
     * Составляем массив из каталогов
     *
     * @param string $file
     * @return void
     */
    public function formatDirectory(string $file) : void
    {
        $file = str_replace('\\', '/', $file);
        $directory = explode('/', $file);
        $last_key = array_key_last($directory);
        array_push($this->result, $directory[$last_key - 1]);
    }

}
