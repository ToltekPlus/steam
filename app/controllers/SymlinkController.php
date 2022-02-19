<?php

namespace App\Controller;

use App\Service\SymlinkBuilder;

class SymlinkController {
    use SymlinkBuilder;

    protected $dir;
    protected $symlink;

    /**
     * Готовим директории
     */
    public function __construct()
    {
        $this->dir = dirname(__DIR__, 2) . $_ENV["SYMLINK_IMAGES_DIRECTORY"];
        $this->symlink = dirname(__DIR__, 2) . $_ENV["IMAGES_DIRECTORY"];
    }

    /**
     * генерируем символические ссылки
     *
     * @return void
     */
    public function generate() : void
    {
        $this->generateTree($this->symlink, $this->dir);

    }
}