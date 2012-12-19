<?php

namespace Nerd\Core\Event\Tests\Stubs;

class ListenerStubFail extends \Nerd\Core\Event\ListenerAbstract
{
	public function qualify(\SplSubject $event)
	{
		return false;
	}

	public function run(\SplSubject $event)
	{
		$event->setArgument('stubrun', true);
	}
}