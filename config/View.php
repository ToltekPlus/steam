<?php

namespace Core;

class View {
    /**
     * Рендерим хэдер
     */
    public static function renderHeader()
    {
        $header = dirname(__DIR__) . "/app/views/layouts/header.php";

        require $header;
    }

    /**
     * Рендерим основной контент страницы
     *
     * @param string $view
     * @param array $args
     * @throws \Exception
     */
    public static function render(string $view, array $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/app/views/$view";

        if (is_readable($file)) {
            require $file;
        }else {
            throw new \Exception("$file не найден");
        }
    }

    /**
     * Рендерим футер
     */
    public static function renderFooter()
    {
        $layout = dirname(__DIR__) . "/app/views/layouts/footer.php";

        require $layout;
    }
}