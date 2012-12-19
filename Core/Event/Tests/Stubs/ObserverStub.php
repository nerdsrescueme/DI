<?php

namespace Nerd\Core\Event\Tests\Stubs;

/**
 * @codeCoverageIgnore
 */
class ObserverStub extends \Nerd\Core\Event\ObserverAbstract
{
    public function update(\SplSubject $event)
    {
        if (method_exists($event, 'setArgument')) {
            $event->setArgument('stubrun', true);
        }

        return 'somevalue';
    }
}