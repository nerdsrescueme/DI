<?php

namespace Nerd\Core\Event;

interface EventInterface extends \SplSubject
{
    public function __construct($name, DispatcherInterface $dispatcher);

    public function getName();

    public function setName($name);

    public function stopPropogation();

    public function isPropogationStopped();

    public function getArgument($key);

    public function setArgument($key, $value);

    // Notifier convenience methods

    public function getObservers();

    public function hasObservers();

    public function attach(\SplObserver $observer);

    public function detach(\SplObserver $observer);

    public function notify();

    // Dispatcher convenience methods

    public function getDispatcher();

    public function hasDispatcher();
}