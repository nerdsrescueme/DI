<?php

namespace Nerd\Core\Event\Tests;

use Nerd\Core\Event\Dispatcher
  , Nerd\Core\Event\Event;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $dispatcher = new Dispatcher;
        $this->assertInstanceOf('Nerd\\Core\\Event\\DispatcherInterface', $dispatcher);
    }

    public function testAttach()
    {
        $dispatcher = new Dispatcher;
        $this->assertSame($dispatcher, $dispatcher->attach('test', new ListenerStub), '->attach() is not chainable');

        $listeners = $dispatcher->get('test');
        $this->assertInstanceOf('\\SplObjectStorage', $listeners, '->get() does not return an instance of SplObjectStorage');
        $this->assertCount(1, $listeners, '->attach() does not assign a listener to an event type');
    }

    public function testGetReturnNullIfEventNotExists()
    {
        $dispatcher = new Dispatcher;
        $this->assertNull($dispatcher->get('fail'), '->get() does not return null for non existent event types');
    }

    /**
     * @depends testAttach
     */
    public function testDetach()
    {
        $dispatcher = new Dispatcher;
        $listener = new ListenerStub;
        $notattached = new ListenerStub;
        $dispatcher->attach('test', $listener);

        $this->assertTrue($dispatcher->detach('test', $listener), '->detach() does not return true when removing a valid listener');
        $this->assertCount(0, $dispatcher->get('test'), '->detach() does not remove a listener');
        $this->assertFalse($dispatcher->detach('test', $notattached), '->detach() falsely reports it removed an invalid listener');
    }

    /**
     * @depends testAttach
     */
    public function testHas()
    {
        $dispatcher = new Dispatcher;
        $listener = new ListenerStub;
        $dispatcher->attach('test', $listener);

        $this->assertTrue($dispatcher->has('test'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDispatchFailsOnInvalidEventType()
    {
        $dispatcher = new Dispatcher;
        $dispatcher->dispatch('test');
    }

    public function testDispatchCreatesBlankEvent()
    {
        $dispatcher = new Dispatcher;
        $dispatcher->attach('test', new ListenerStub);
        $event = $dispatcher->dispatch('test');

        $this->assertInstanceOf('\\Nerd\\Core\\Event\\EventInterface', $event, '->dispatch() did not create a new Event object');
        $this->assertSame('test', $event->getName(), '->dispatch() did not properly name the new Event object');
        $this->assertSame($dispatcher, $event->getDispatcher(), '->dispatch() did not properly assign the dispatcher object on the new Event object');
    }

    public function testDispatchUsesInjectedEvent()
    {
        $dispatcher = new Dispatcher;
        $dispatcher->attach('test', new ListenerStub);
        $event = new \Nerd\Core\Event\Event('test', $dispatcher);

        $this->assertSame($event, $dispatcher->dispatch('test', $event), '->dispatch() did not return the injected Event object');
    }

    public function testDispatch()
    {
        $dispatcher = new Dispatcher;
        $event = new \Nerd\Core\Event\Event('test', $dispatcher);
        $event->setArgument('stubrun', false);
        $event->setArgument('stubrunfail', false);
        $dispatcher->attach('test', new ListenerStub);
        $dispatcher->attach('test', new ListenerStubFail);
        $dispatcher->dispatch('test', $event);

        $this->assertTrue($event->getArgument('stubrun'), '->dispatch() could not run the ListenerStub listener');
        $this->assertFalse($event->getArgument('stubrunfail'), '->dispatch() ran ListenerStubFail but shouldn\'t have');

        $event->setArgument('stubrun', false);
        $event->setArgument('stubrunfail', false);

        $dispatcher->attach('test', new ListenerStubRunsFirst);
        $event = $dispatcher->dispatch('test', $event);

        $this->assertFalse($event->getArgument('stubrun'), '->dispatch() did not stop propogation on ListenerStubRunsfirst');
    }
}