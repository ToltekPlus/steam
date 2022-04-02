<?php

namespace Test\Unit\Model;

use App\Model\GenreModel;
use Test\Unit\BaseTest\ModelTest;

class GenreModelTest extends ModelTest {
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
        $this->testGetAll();
    }

    public function testStore()
    {
        $this->testGetStore();
    }
}
