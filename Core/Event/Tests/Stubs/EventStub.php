<?php

namespace Nerd\Core\Event\Tests\Stubs;

/**
 * @codeCoverageIgnore
 */
class EventStub implements \SplSubject
{
    public function attach(\SplObserver $observer) {}
    public function detach(\SplObserver $observer) {}
    public function notify() {}
}