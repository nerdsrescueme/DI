<?php

namespace Nerd\Core\Event\Tests;

class ObserverStub extends \Nerd\Core\Event\ObserverAbstract
{
	public function update(\SplSubject $event)
	{
		$event->setArgument('stubrun', true);
	}
}