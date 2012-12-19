<?php

namespace Nerd\Core\Event\Tests\Stubs;

class ListenerStub extends \Nerd\Core\Event\ListenerAbstract
{
    protected $priority = 10;

    public function run(\SplSubject $event)
    {
    	if (method_exists($event, 'setArgument')) {
            $event->setArgument('stubrun', true);
        }

        return 'somevalue';
    }
}