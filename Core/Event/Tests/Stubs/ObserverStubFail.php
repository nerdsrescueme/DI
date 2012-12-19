<?php

namespace Nerd\Core\Event\Tests\Stubs;

class ObserverStubFail extends \Nerd\Core\Event\ObserverAbstract
{
	protected $priority = 5;

	public function qualify(\SplSubject $event)
	{
		return false;
	}

	public function update(\SplSubject $event)
	{
		$event->setArgument('stubfailrun', true);
	}
}