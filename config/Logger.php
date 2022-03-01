<?php

namespace Core;

class Logger {
    /**
     * массив логгеров с разными файлами
     *
     * @var array
     */
    protected static $loggers = [];

    /**
     * имя текущего логгера
     *
     * @var
     */
    protected $name;

    /**
     * пусть к файлу логгера
     *
     * @var
     */
    protected $file;

    /**
     * файловый поток
     *
     * @var
     */
    protected $fp;

    public function __construct($name, $file = null)
    {
        $this->name = $name;
        $this->file = $file;

        $this->open();
    }

    /**
     * Если переменная не заданая, то будет открыт файл с тем же именем,
     * что и логгер
     *
     * @return void
     */
    public function open()
    {
        if ($_ENV['LOGGER_PATH'] == null) {
            return;
        }

        $this->fp = fopen($this->file == null ? dirname(__DIR__, 1) . $_ENV['LOGGER_PATH'] . '/' . $this->name . '.log' : dirname(__DIR__, 1) . $_ENV['LOGGER_PATH'].'/'.$this->file,'a+');
    }

    /**
     * возврат логгера, имя которого указано
     *
     * @param $name
     * @param $file
     * @return Logger|mixed
     */
    public static function getLogger($name = 'root', $file = null)
    {
        if (!isset(self::$loggers[$name])) {
            self::$loggers[$name] = new Logger($name, $file);
        }

        return self::$loggers[$name];
    }

    /**
     * @param $code
     * @param $message
     * @return void
     */
    public function log($code, $message)
    {
        if (!is_string($message)) {
            // если желаем вывести массив
            $this->logPrint($message);
            return;
        }

        $log = '';
        // если параметров больше одного, то выведем их тоже
        if (func_num_args() > 1) {
            $param = func_get_args();

            $p = call_user_func_array('sprintf', $param);
        }

        $log .= '[' . $p . ']';

        // фиксируем дату и код ошибки
        $log .= '[' . date('D M d h:i:s Y', time()) . '] ';

        $log .= '[' . $message . '] ';
        $log .= "\n";

        // запишем в файл
        $this->write($log);
    }

    /**
     * заносим данные, очищаем буфер и записываем
     *
     * @param $object
     * @return void
     */
    public function logPrint($object)
    {
        ob_start();

        print_r($object);

        $ob = ob_get_clean();

        $this->log($object);
    }

    /**
     * @param $string
     * @return void
     */
    public function write($string)
    {
        fwrite($this->fp, $string);
    }

    /**
     *
     */
    public function __destruct()
    {
        fclose($this->fp);
    }
}