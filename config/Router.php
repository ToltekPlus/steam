<?php

namespace Core;

class Router {
    /**
     * здесь будет наш ассоциативный массив маршрутов
     * @var array
     */
    protected $routes = [];

    /**
     * здесь будем передавать параметры маршрута
     * @var array
     */
    protected $params = [];

    /**
     * реализация добавления маршрута в роутинг
     *
     * @param string $route  адрес
     * @param array  $params параметры
     *
     * @return void
     */
    public function add($route, $params = [])
    {
        // преобразуем маршрут (работаем со слешами)
        $route = preg_replace('/\//', '\\/', $route);

        // преобразуем переменный по типу -> {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // преобразуем переменный по типу -> {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // добавляем разделители
        // регистронезависимые
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * получаем все роутеры
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * сопоставляем маршруты с параметрами маршрутизации
     * если есть параметры, то тоже забираем
     *
     * @param string $url урлочка
     *
     * @return boolean  тру если есть совпадение, иначе фолсе
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            // ищем совпадение роутера со строкой урл (и дополнительные параметры, если есть)
            if (preg_match($route, $url, $matches)) {
                // получаем именованые значения
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * получаем все необходимые параметры
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * объявляем котроллер, создаем маршрут и добавляем метод для выполнения
     *
     * @param $url
     * @throws \Exception
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller; // составляем пространство имен

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/action$/i', $action) == 0) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Метод $action в котнроллере $controller не может быть вызван");
                }
            } else {
                throw new \Exception("Контроллер $controller не найден");
            }
        } else {
            throw new \Exception('Роут не отрабатывает.', 404);
        }
    }

    /**
     * преобразуем строку с дефисами,
     * например user-account => UserAccount
     *
     * @param string $string строка для конвертации
     *
     * @return string
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * преобразуем строку в камел кейс,
     * например add-new => addNew
     *
     * @param string $string строка для конвертации
     *
     * @return string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * Удаляем переменный в строке урл-запроса
     * Это нужно для того чтобы сопоставить адрес с таблицей маршрутов
     * Например
     *
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?id=1             user=1                      ''
     *   localhost/users?id=1        user&ide=1                 users
     *   localhost/users/index       users/index                users/index
     *   localhost/users/index?id=1  users/index&id=1           users/index
     *
     * НО!!! Если урлочка имеет вид localhost/? (только переменная, без значения)
     * то маршрутизатор ломается. Поэтому .htaccess все это дело преобразует
     * когда переменная передается в переменную $_SERVER
     *
     * @param string $url полный урл
     *
     * @return string урл с удаленными параметрами запроса
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            // ищем в массиве что нибудь со знаком "="
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * получаем данные для пространство имен
     *
     * @return string The request URL
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controller\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}