<?php

namespace App\Service;

trait UploadFile {
    // TODO разобраться с косяком загрузки png-изображений
    //параметры загружаемых изображений
    private $valid_types = ['image/png', 'image/jpg', 'image/jpeg'];
    private $max_size = 1000000 * 1024;

    /**
     * Загрузка файла
     *
     * @param array $image
     * @param string $path
     * @return string
     */
    public function upload(array $image, string $path) : string
    {
        $upload_file_path = dirname(__DIR__, 2) . $path;
        // Проверяем тип файла
        $type_image = $this->getImageType($image['tmp_name']);
        if (!$type_image) return false;

        $src = $this->createFileName($image['name'], $path, $type_image);

        // Проверяем тип файла, размер
        // Также создаем каталог загрузки, если он отсутствует
        if ($this->checkTypeFile($type_image)) {
            if ($image['size'] < $this->max_size) {
                if (!file_exists($upload_file_path)) mkdir($upload_file_path);
                if (move_uploaded_file($image['tmp_name'], $src['src'])) return $src['path']; else echo 'Ошибка при загрузке';
            }
            else exit('Файл большого размера.' . '<br>');
        }
        else exit('Тип файла не подходит' . '<br>');
    }

    /**
     * Получаем тип данных
     *
     * @param string $image
     * @return array|false
     */
    protected function getImageType(string $image) : ?array
    {
        if (empty($image)) return false; else return getimagesize($image);
    }

    /**
     * Создаем имя и путь к файлу
     *
     * @param $image
     * @param $path
     * @param $type
     * @return array
     */
    protected function createFileName($image, $path, $type)
    {
        $upload_file_path = dirname(__DIR__, 2) . $path;
        $extension = pathinfo($image, PATHINFO_EXTENSION);

        // Если разрешение отсутствует, то получаем его из type
        // т.е. в mime тип хранится в формате */*, то получаем второй элемент
        // через explode и используем как разрешение
        if (!$extension) $extension = explode('/', $type['mime'][1]);
        $name = time() . '_' . mt_rand(27, 99999999999);
        $src = $upload_file_path . $name . '.' . $extension;
        $result = $path . $name . '.' . $extension;

        return [
            'src' => $src,
            'path' => $result
        ];
    }

    /**
     * Проверка типа файла на соответствие параметра
     *
     * @param array $type
     * @return bool
     */
    protected function checkTypeFile(array $type) : bool
    {
        if (!$type) return false;

        $result = array_search($type['mime'], $this->valid_types, true);
        if (!empty($result)) return true;

        return false;
    }
}