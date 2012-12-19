<?php

namespace Nerd\Core\Event\Tests\Stubs;

class ListenerStubRunsFirst extends \Nerd\Core\Event\ListenerAbstract
{
	protected $priority = 1;

	public function run(\SplSubject $event)
	{
		$event->stopPropogation();
	}
}