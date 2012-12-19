<?php

namespace Nerd\Core\Event\Tests;

use Nerd\Core\Event\EventInterface;

class ListenerStubRunsFirst extends \Nerd\Core\Event\ListenerAbstract
{
	protected $priority = 1;

	public function __invoke(EventInterface $event)
	{
		$event->stopPropogation();
	}
}