<?php

namespace Nerd\Core\Event;

class Event implements \SplSubject, EventInterface
{
    const MODE_DISPATCHER = 0;
    const MODE_NOTIFIER = 1;

    protected $dispatcher;
    protected $name;
    protected $propogate = true;
    protected $arguments = [];
    protected $observers;
    protected $mode;

    public function __construct($name, DispatcherInterface $dispatcher = null)
    {
        $this->setName($name);

        if ($dispatcher === null) {
            $this->mode = self::MODE_NOTIFIER;
            $this->observers = new \SplObjectStorage();
        } else {
            $this->mode = self::MODE_DISPATCHER;
            $this->dispatcher = $dispatcher;
        }
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function isNotifier()
    {
        return $this->getMode() === self::MODE_NOTIFIER;
    }

    public function isDispatcher()
    {
        return $this->getMode() === self::MODE_DISPATCHER;
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
        if (!$this->isNotifier()) {
            throw new \BadMethodCallException("Event [$this->getName()] is not a notifier");
        }

        $this->observers->attach($observer);

        return $this;
    }

    public function detach(\SplObserver $observer)
    {
        if (!$this->isNotifier()) {
            throw new \BadMethodCallException("Event [$this->getName()] is not a notifier");
        }

        $this->observers->detach($observer);

        return $this;
    }

    public function notify()
    {
        if (!$this->isNotifier()) {
            throw new \BadMethodCallException("Event [$this->getName()] is not a notifier");
        }

        foreach ($this->observers as $observer) {
            $observer->qualify($this) and $observer->update($this);
        }

        return $this;
    }

    // Dispatcher Methods!
    public function dispatch()
    {
        if (!$this->isDispatcher()) {
            throw new \BadMethodCallException("Event [$this->getName()] is not a dispatcher");
        }

        $this->propogate = true;
        $this->getDispatcher()->dispatch($this->getName(), $this);
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }
}