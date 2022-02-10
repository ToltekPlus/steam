<?php

namespace App\Service;

trait DeleteFile {
    /**
     * @param $link
     */
    public function deleteImage($link)
    {
        $image = dirname(__DIR__, 2) . $link;

        if(file_exists($image)) unlink($image);
    }
}