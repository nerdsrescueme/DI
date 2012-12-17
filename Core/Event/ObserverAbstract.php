<?php 

namespace Nerd\Core\Event;

abstract class ObserverAbstract implements \SplObserver
{
	public function qualify(\SplSubject $event)
	{
		return true;
	}

	abstract public function update(\SplSubject $event);
}