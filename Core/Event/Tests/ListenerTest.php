<?php

namespace Nerd\Core\Event\Tests;

class ListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $listener = new Stubs\ListenerStub;
        $this->assertInstanceOf('\\Nerd\\Core\\Event\\ListenerInterface', $listener);
    }

    public function testPriorityExists()
    {
        $listener = new Stubs\ListenerStubNoPriority;
        $this->assertTrue(property_exists($listener, 'priority'), '->priority does not exist by default');
        $this->assertSame(0, $listener->getPriority(), '->priority does not default to 0');
    }

    public function testQualifyReturnsTrueByDefault()
    {
        $listener = new Stubs\ListenerStub;
        $event = new Stubs\EventStub;
        $this->assertTrue($listener->qualify($event), '->qualify() does not return true by default');
    }

    public function testProvidesCallableInvoker()
    {
        $listener = new Stubs\ListenerStub;
        $event = new Stubs\EventStub;
        $this->assertTrue(is_callable($listener), '->__invoke() is not callable');
    }

    /**
     * @depends testProvidesCallableInvoker
     */
    public function testInvokeReturnsArbitraryValue()
    {
        $listener = new Stubs\ListenerStub;
        $event = new Stubs\EventStub;
        $this->assertSame('somevalue', $listener($event), '->__invoke() does not return value returned by update()');
    }
}