<?php

namespace Nerd\Core\Event\Tests\Stubs;

/**
 * @codeCoverageIgnore
 */
class EventObserverStub implements \SplObserver
{
	public function qualify(\SplSubject $subject)
	{
		return true;
	}

	public function update(\SplSubject $subject)
	{
		echo 'STUB';
	}
}