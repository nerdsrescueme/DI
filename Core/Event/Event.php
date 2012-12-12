<?php

namespace Nerd\Core\Event;

class Event implements EventInterface
{
    protected $dispatcher;
    protected $name;
    protected $propogate = true;
    protected $arguments = [];

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

	public function getArgument($key, $default = null)
	{
		if (isset($this->arguments[$key])) {
			return $this->arguments[$key];
		}

		return $default;
	}

	public function setArgument($key, $value)
	{
		$this->arguments[$key] = $value;
	}

    public function stopPropogation()
    {
        $this->propogate = false;

        return $this;
    }
}