<?php

namespace Test\Unit\BaseTest;

use App\Service\QueryBuilder;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase {
    use QueryBuilder;

    /**
     * @var
     */
    protected $stub;

    /**
     * Получение всех записей
     */
    public function testGetAll()
    {
        $table = 'test';
        $this->stub->method('getAll')
            ->willReturn([]);

        $this->assertSame([], $this->stub->getAll($table));
    }

    /**
     * Проверяем что возврат объекта - ошибка
     */
    public function testGetAllObjectReturnError()
    {
        $object = new \stdClass();

        $this->stub->method('getAll')
            ->willReturn([]);

        $this->assertNotEquals($object, $this->stub->all());
    }

    /**
     * Получение данных из нескольких таблиц
     */
    public function testGetAllPivot()
    {
        $table = [];
        $id = 1;

        $sql = $this->queryBuilder($table, $id);

        $this->stub->method('getAllPivot')
            ->willReturn([]);

        $this->assertSame([], $this->stub->getAllPivot($table, $id));
    }

    /**
     * Проверяем добавление
     */
    public function testGetStore()
    {
        $args = [];

        $this->stub->method('getAllPivot')
            ->willReturn(null);

        $this->assertSame(null, $this->stub->store($args));
    }

}
