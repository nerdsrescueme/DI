<?php 

namespace Nerd\Core\Event;

interface ObserverInterface extends \SplObserver
{
	public function qualify(\SplSubject $event);

	public function __invoke(\SplSubject $event);
}