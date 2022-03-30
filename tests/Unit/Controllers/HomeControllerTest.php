<?php

namespace Test\Unit\Controller;

use App\Controller\HomeController;
use Test\Unit\BaseTest\ControllerTest;

class HomeControllerTest extends ControllerTest {
    /**
     * @var
     */
    protected $stub;

    /**
     *
     */
    public function  setUp(): void
    {
        $this->stub = $this->createMock(HomeController::class);
    }

    /**
     * Проверяем что метод вернет пустой результат
     *
     * @throws \Exception
     */
    public function testIndexPage()
    {
        $this->assertNull($this->stub->index());
    }

    /**
     * Проверяем возвращается ли массив от передачи данных
     */
    public function testAddOtherInformation()
    {
        $games = [];

        $this->stub
            ->method('addOtherInformation')
            ->with($games)
            ->willReturn([]);

        $this->assertSame([], $this->stub->addOtherInformation($games));
    }
}
