<?php

namespace Nerd\Core\Event\Tests\Stubs;

class ListenerStubRunsLast extends \Nerd\Core\Event\ListenerAbstract
{
	protected $priority = 10;

	public function run(\SplSubject $event)
	{
		$event->setArgument('laststubrun', true);
	}
}