<?php declare(strict_types=1);


namespace SwoftTest\Task\Unit;

use Swoft\Context\Context;
use Swoft\Task\Exception\TaskException;

/**
 * Class TaskTest
 *
 * @since 2.0
 */
class TaskTest extends TestCase
{
    /**
     * @throws TaskException
     * @expectedException \Swoft\Task\Exception\TaskException
     */
    public function testCo()
    {
        $this->mockTaskServer->co('demoTestTask', 'method', []);
    }

    /**
     * @throws TaskException
     */
    public function testCo2()
    {
        $data   = [
            'name',
            18306
        ];
        $result = $this->mockTaskServer->co('demoTestTask', 'method', ['name', 18306]);
        $this->assertEquals($result, $data);
    }

    /**
     * @throws TaskException
     */
    public function testCo3()
    {
        $data   = [
            'name',
            18306,
            'type'
        ];
        $result = $this->mockTaskServer->co('demoTestTask', 'method2', ['name', 18306]);
        $this->assertEquals($result, $data);

        $data   = [
            'name',
            18306,
            'defaultType'
        ];
        $result = $this->mockTaskServer->co('demoTestTask', 'method2', ['name', 18306, 'defaultType']);
        $this->assertEquals($result, $data);

        Context::getWaitGroup()->wait();
    }

    /**
     * @throws TaskException
     * @expectedException \Swoft\Task\Exception\TaskException
     */
    public function testCo6()
    {
        $this->mockTaskServer->co('demoTestTask', 'method3', ['name', 18306]);
    }

    /**
     */
    public function testAsync()
    {
//        $id = $this->mockTaskServer->async('demoTestTask', 'method2', ['name', 18306]);
//        $this->assertGreaterThan(0, $id);
    }

    /**
     * @throws TaskException
     */
    public function testContext()
    {
        $data = [
            'unit-1',
            1,
            'co',
            'demoTestTask',
            'method6',
            [
                'name',
                18306
            ],
        ];

        $result = $this->mockTaskServer->co('demoTestTask', 'method6', ['name', 18306]);
        $this->assertEquals($data, $result);
    }

    /**
     * @throws TaskException
     */
    public function testNotMapping()
    {
        $result = $this->mockTaskServer->co('demoTestTask', 'notMapping', []);
        $this->assertEquals($result, ['notMapping']);
    }

    /**
     * @throws TaskException
     */
    public function testBooReturn()
    {
        $result = $this->mockTaskServer->co('demoTestTask', 'booReturn', []);
        $this->assertTrue($result);
    }

    /**
     * @throws TaskException
     */
    public function testNullReturn()
    {
        $result = $this->mockTaskServer->co('demoTestTask', 'nullReturn', []);
        $this->assertNull($result);
    }

    /**
     * @throws TaskException
     */
    public function testVoidReturn()
    {
        $result = $this->mockTaskServer->co('demoTestTask', 'voidReturn2', []);
        $this->assertNull($result);
    }
}