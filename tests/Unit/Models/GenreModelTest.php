<?php

namespace Test\Unit\Model;

use App\Model\GenreModel;
use PHPUnit\Framework\TestCase;

class GenreModelTest extends TestCase {
    /**
     * @var GenreModel|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stub;

    /**
     *
     */
    public function setUp(): void
    {
        $this->stub = $this->createMock(GenreModel::class);
    }

    /**
     * Проверяем что должен возвращаться массив
     */
    public function testAll()
    {
        $this->stub->method('getAll')
            ->willReturn([]);

        $this->assertSame([], $this->stub->all());
    }


    /**
     * Проверяем что возврат объекта - ошибка
     */
    public function testAllObjectReturnError()
    {
        $object = new \stdClass();

        $this->stub->method('getAll')
            ->willReturn([]);

        $this->assertNotEquals($object, $this->stub->all());
    }
}
