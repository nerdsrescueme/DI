<?php

namespace Nerd\Core\Event\Tests;

use Nerd\Core\Event\Event
  , Nerd\Core\Event\Dispatcher
  , Nerd\Core\Event\Observer;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $event = new Event('test');
        $this->assertInstanceOf('Nerd\\Core\\Event\\EventInterface', $event);
        $this->assertInstanceOf('\\SplSubject', $event);
    }

    public function testConstruction()
    {
        $event = new Event('test');
        $this->assertSame('test', $event->getName(), '->__construct() did not set the name of this event');

        // Construction with dispatcher
        $dispatcher = new Dispatcher;
        $event = new Event('test', $dispatcher);
        $this->assertSame($dispatcher, $event->getDispatcher(), '->__construct() did not set the event dispatcher property');
        $this->assertTrue($event->hasDispatcher(), '->hasDispatcher() can not determine if there is an event dispatcher');

        // Notifier only construction
        $event = new Event('test');
        $this->assertInstanceOf('\\SplObjectStorage', $event->getObservers());
        $this->assertFalse($event->hasObservers());
    }

    public function testSetName()
    {
        $event = new Event('test');
        $this->assertSame($event, $event->setName('newtest'), '->setName() is not chainable');
        $this->assertSame('newtest', $event->getName(), '->setName() does not set the name property');
    }

    public function testPropogation()
    {
        $event = new Event('test');
        $this->assertFalse($event->isPropogationStopped(), '->propogate is not true by default');
        $this->assertSame($event, $event->stopPropogation(), '->stopPropogation() is not chainable');
        $this->assertTrue($event->isPropogationStopped(), '->stopPropogation() does not stop propogation');
    }

    public function testArguments()
    {
        $event = new Event('test');
        $this->assertSame($event, $event->setArgument('key', 'value'), '->setArgument() is not chainable');
        $this->assertSame('value', $event->getArgument('key'), '->setArgument() doe not assign a key/val pair');
        $this->assertNull($event->getArgument('fail'), '->getArgument() does not return a null value for an unassigned key');
    }

    public function testNotify()
    {
        $event = new Event('test');
        $notifier = new Stubs\EventObserverStub;

        $this->expectOutputString('EVENT_OBSERVER_STUB_RAN');

        $event->setArgument('stubrun', false);

        $this->assertSame($event, $event->attach($notifier), '->attach() is not chainable');
        $this->assertCount(1, $event->getObservers(), '->attach() did not assign the observer to this event');
        $this->assertSame($event, $event->notify(), '->notify() is not chainable');
        $this->assertSame($event, $event->detach($notifier), '->detach() is not chainable');
        $this->assertCount(0, $event->getObservers(), '->detach() did not remove the observer from this event');
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testNotifyFails()
    {
        $event = new Event('test');
        $event->notify();
    }
}