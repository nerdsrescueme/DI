<?php

namespace Nerd\Core\Event\Tests\Stubs;

/**
 * @codeCoverageIgnore
 */
class EventObserverStubFail implements \SplObserver
{
	public function qualify(\SplSubject $subject)
	{
		return false;
	}

	public function update(\SplSubject $subject)
	{
		// Shouldn't run;
		$event->setArgument('failerran', true);
	}
}