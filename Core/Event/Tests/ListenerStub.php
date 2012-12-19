<?php

namespace Nerd\Core\Event\Tests;

use Nerd\Core\Event\EventInterface;

class ListenerStub extends \Nerd\Core\Event\ListenerAbstract
{
	protected $priority = 10;

	public function __invoke(EventInterface $event)
	{
		$event->setArgument('stubrun', true);
	}
}