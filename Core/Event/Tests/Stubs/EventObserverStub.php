<?php

namespace Nerd\Core\Event\Tests\Stubs;

class EventObserverStub implements \SplObserver
{
	public function update(\SplSubject $subject)
	{
		echo 'EVENT_OBSERVER_STUB_RAN';
	}
}