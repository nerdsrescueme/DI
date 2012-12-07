<?php

namespace Nerd\Event;

class Event implements EventInterface
{
    protected $dispatcher;
    protected $name;
    protected $propogate = true;

    public function __construct($name, DispatcherInterface $dispatcher)
    {
        $this->name = $name;
        $this->dispatcher = $dispatcher;
    }

    public function isPropogationStopped()
    {
        return $this->propogate;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function getName()
    {
        return $this->name;
    }

    public function stopPropogation()
    {
        $this->propogate = false;

        return $this;
    }
}