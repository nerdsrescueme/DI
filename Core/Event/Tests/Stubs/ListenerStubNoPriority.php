<?php

namespace Nerd\Core\Event\Tests\Stubs;

class ListenerStubNoPriority extends \Nerd\Core\Event\ListenerAbstract
{
	public function run(\SplSubject $event)
	{
		// Do nothing...
	}
}