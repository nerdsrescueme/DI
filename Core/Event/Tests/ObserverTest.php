<?php

namespace Nerd\Core\Event\Tests;

class ObserverTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $observer = new Stubs\ObserverStub;
        $this->assertInstanceOf('\\Nerd\\Core\\Event\\ObserverInterface', $observer);
        $this->assertInstanceOf('\\SplObserver', $observer);
    }

    public function testQualifyReturnsTrueByDefault()
    {
        $observer = new Stubs\ObserverStub;
        $event = new Stubs\EventStub;
        $this->assertTrue($observer->qualify($event), '->qualify() does not return true by default');
    }

    public function testProvidesCallableInvoker()
    {
        $observer = new Stubs\ObserverStub;
        $event = new Stubs\EventStub;
        $this->assertTrue(is_callable($observer), '->__invoke() is not callable');
    }

    /**
     * @depends testProvidesCallableInvoker
     */
    public function testInvokeReturnsArbitraryValue()
    {
        $observer = new Stubs\ObserverStub;
        $event = new Stubs\EventStub;
        $this->assertSame('somevalue', $observer($event), '->__invoke() does not return value returned by update()');
    }
}