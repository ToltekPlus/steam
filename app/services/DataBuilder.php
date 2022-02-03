<?php

namespace App\Service;

trait DataBuilder {
    /**
     * Формируем массив данных для добавления/обновления
     * и возвращаем
     *
     * @param array $post
     * @param array|null $other
     * @return array
     */
    public function dataBuilder(array $post, array $other = null) : array
    {
        $post['created_at'] = date('Y-m-d H:i:s', time());
        $post['updated_at'] = date('Y-m-d H:i:s', time());

        if (is_null($other)) return $post;

        foreach ($other as $key => $value) {
            $post[$key] = $value;
        }

        return $post;
    }
}