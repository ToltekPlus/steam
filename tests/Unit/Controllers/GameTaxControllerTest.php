<?php

namespace Test\Unit\Controller;

use App\Model\TaxGameModel;
use Test\Unit\BaseTest\ControllerTest;

class GameTaxControllerTest extends ControllerTest {
    /**
     * @var
     */
    protected $stub;

    /**
     *
     */
    public function setUp() : void
    {
        $this->stub = $this->createMock(TaxGameModel::class);
    }

    /**
     * Проверяем что данные отправятся на добавление правильно
     * и вернется мавссив
     */
    public function testStore()
    {
        $this->getTestCheckStore();
    }

    /**
     * Проверяем что данные, которые отправятся в
     * DataBuilder будут правильно сформированы и приняты
     */
    public function testDataBuilder()
    {
        $this->getTestDataForStoreAndUpdate();
    }

    /**
     * Проверяем, что метод поиска по id будет правильно выполнен
     */
    public function testGet()
    {
        $this->getTestGet();
    }
}
