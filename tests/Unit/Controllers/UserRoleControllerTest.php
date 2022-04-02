<?php

namespace Test\Unit\Controller;

use App\Model\UserRoleModel;
use Test\Unit\BaseTest\ControllerTest;

class UserRoleControllerTest extends ControllerTest {
    /**
     * @var
     */
    protected $stub;

    /**
     *
     */
    public function setUp(): void
    {
        $this->stub = $this->createMock(UserRoleModel::class);
    }

    /**
     * Возвращаем объект при вызове одного жанра
     */
    public function testGet()
    {
        $this->getTestGet();
    }

    /**
     * Проверяем, что возвращается объект
     */
    public function testGetObject()
    {
        $this->getTestObject();
    }
}
