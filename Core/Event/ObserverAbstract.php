<?php 

namespace Nerd\Core\Event;

abstract class ObserverAbstract implements ObserverInterface
{
	public function qualify(\SplSubject $event)
	{
		return true;
	}

	abstract public function update(\SplSubject $event);

	public function __invoke(\SplSubject $event)
	{
		return $this->update($event);
	}
}