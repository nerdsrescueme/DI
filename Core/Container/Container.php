<?php

namespace Nerd\Core\Container;

class Container implements ContainerInterface
{
    public $name;

    protected $objects = [];

    public function set($name, $class)
    {
        if ($class instanceof Aware) {
            $class->setContainer($this);
        }

        $this->objects[$name] = $class;

        return $class;
    }

	public function __set($property, $value)
	{
		$this->set($property, $value);
	}

    public function delete($name)
    {
        if ($this->has($name)) {
            unset($this->objects[$name]);
            return true;
        }

        return false;
    }

    public function get($name)
    {
        if (!$this->has($name)) {
            throw new \InvalidArgumentException("Class alias [$name] has not been registered");
        }

        return $this->objects[$name];
    }

	public function __get($property)
	{
		return $this->get($property);
	}

    public function has($name)
    {
        return isset($this->objects[$name]);
    }
}