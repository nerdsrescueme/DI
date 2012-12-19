<?php

namespace Nerd\Core\Event\Tests\Stubs;

/**
 * @codeCoverageIgnore
 */
class ListenerStubNoPriority extends \Nerd\Core\Event\ListenerAbstract
{
	public function run(\SplSubject $event)
	{
		// Do nothing...
	}
}