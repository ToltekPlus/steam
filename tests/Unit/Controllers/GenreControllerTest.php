<?php

namespace Test\Unit\Controller;

use App\Model\GenreModel;
use App\Service\DataBuilder;
use PHPUnit\Framework\TestCase;

class GenreControllerTest extends TestCase {
    use DataBuilder;

    /**
     * @var GenreModel|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stub;

    public function setUp(): void
    {
        $this->stub = $this->createMock(GenreModel::class);
    }

    /**
     * Проверяем возврат массива из метода all()
     */
    public function testIndex()
    {
        $this->stub->method('all')
            ->willReturn([]);

        $this->assertSame([], $this->stub->all());
    }

    /**
     * Возвращаем объект при вызове одного жанра
     */
    public function testGet()
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
    public function testGetObject()
    {
        $id = 1;

        $this->assertIsObject($this->stub->find($id));
    }

    /**
     * Проверяем возвращается ли массив данных при построении запроса
     */
    public function testDataForStoreAndUpdate()
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
    public function testNotEqualsDataForStoreAndUpdate()
    {
        $result = 'error';

        $args = $this->dataBuilder([]);
        $this->assertNotEquals($result, $args);
    }
}
