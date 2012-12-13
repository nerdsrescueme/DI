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

    public function dispatch()
    {
        $this->getDispatcher()->dispatch($this->getName(), $this);
    }

    public function isPropogationStopped()
    {
        return ! $this->propogate;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
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

		throw new \InvalidArgumentException('Argument has not been set');
	}

	public function setArgument($key, $value)
	{
		$this->arguments[$key] = $value;

        return $this;
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
}