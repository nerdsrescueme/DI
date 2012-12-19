<?php

namespace Nerd\Core\Event\Tests;

use Nerd\Core\Event\EventInterface;

class ListenerStubFail extends \Nerd\Core\Event\ListenerAbstract
{
	public function qualify(EventInterface $event)
	{
		return false;
	}

	public function __invoke(EventInterface $event)
	{
		$event->setArgument('stubrun', true);
	}
}