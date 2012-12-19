<?php

namespace Nerd\Core\Event;

class Event implements EventInterface
{
    protected $dispatcher;
    protected $name;
    protected $propogate = true;
    protected $arguments = [];
    protected $observers;
    protected $mode;

    public function __construct($name, DispatcherInterface $dispatcher = null)
    {
        $this->setName($name);
        $this->observers = new \SplObjectStorage();
        $this->dispatcher = $dispatcher;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getArgument($key)
    {
        if (isset($this->arguments[$key])) {
            return $this->arguments[$key];
        }
    }

    public function setArgument($key, $value)
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    public function isPropogationStopped()
    {
        return ! $this->propogate;
    }

    public function stopPropogation()
    {
        $this->propogate = false;

        return $this;
    }

    public function __get($property)
    {
        return $this->getArgument($property);
    }

    public function __set($property, $value)
    {
        $this->setArgument($property, $value);
    }

    // Observer methods!
    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);

        return $this;
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);

        return $this;
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            if (method_exists($observer, 'qualify')) {
                if (!$observer->qualify($this)) {
                    continue;
                }
            }
            $observer->update($this);
        }

        return $this;
    }

    public function getObservers()
    {
        return $this->observers;
    }

    public function hasObservers()
    {
        return count($this->observers) > 0;
    }

    // Dispatcher Methods!

    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function hasDispatcher()
    {
        return $this->dispatcher instanceof DispatcherInterface;
    }
}