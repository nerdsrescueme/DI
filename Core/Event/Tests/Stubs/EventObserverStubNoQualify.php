<?php

namespace Nerd\Core\Event\Tests\Stubs;

/**
 * @codeCoverageIgnore
 */
class EventObserverStubNoQualify implements \SplObserver
{
	public function update(\SplSubject $subject)
	{
		echo 'STUB';
	}
}