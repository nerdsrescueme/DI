<?php

namespace Nerd\Core\Event\Tests;

use Nerd\Core\Event\Dispatcher
  , Nerd\Core\Event\Event;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $dispatcher = new Dispatcher;
        $this->assertInstanceOf('Nerd\\Core\\Event\\Dispatcher', $dispatcher);
    }
}