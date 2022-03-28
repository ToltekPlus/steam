<?php

namespace Test\Unit\BaseTest;

use App\Service\DataBuilder;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase {
    use DataBuilder;

    /**
     * @var
     */
    protected $stub;

    /**
     * Проверяем возврат массива из метода all()
     *
     * @return void
     */
    public function getTestIndex()
    {
        $this->stub->method('all')
            ->willReturn([]);

        $this->assertSame([], $this->stub->all());
    }

    /**
     * Возвращаем объект при вызове одного жанра
     *
     * @return void
     */
    public function getTestGet()
    {
        $object = new \stdClass();

        $id = 1;

        $this->stub->expects($this->exactly($id))
            ->method('find')
            ->willReturn($object);

        $this->assertSame($object, $this->stub->find($id));
    }

    /**
    * Проверяем, что возвращается объект
    */
    public function getTestObject()
    {
        $id = 1;

        $this->assertIsObject($this->stub->find($id));
    }

    /**
    * Проверяем возвращается ли массив данных при построении запроса
    */
    public function getTestDataForStoreAndUpdate()
    {
        $result = [
        'created_at' => date('Y-m-d H:i:s', time()),
        'updated_at' => date('Y-m-d H:i:s', time())
        ];

        $args = $this->dataBuilder([]);
        $this->assertEquals($result, $args);
    }

    /**
    * Проверяем что данные будут ошибочны, если вернется не массив
    */
    public function getTestNotEqualsDataForStoreAndUpdate()
    {
        $result = 'error';

        $args = $this->dataBuilder([]);
        $this->assertNotEquals($result, $args);
    }

    /**
     * Првоеряем что store работает с массивом
     *
     * @return void
     */
    public function getTestCheckStore()
    {
        $this->stub->method('store')
            ->willReturn([]);

        $this->assertSame([], $this->stub->store([]));
    }

    /**
     * Проверяем удаление с id
     *
     * @return void
     */
    public function getTestDelete()
    {
        $this->stub->method('delete')
            ->willReturn(true);

        $this->assertSame(true, $this->stub->delete(1));
    }
}
