<?php

namespace Nerd\Container;

class Container implements ContainerInterface
{
    public $name;

    protected $objects = [];

    public function set($class, $name)
    {
        if (isset($this->objects[$name])) {
            throw new \InvalidArgumentException("Class alias [$name] is already registered within container");
        }

        if ($class instanceof Aware) {
            $class->setContainer($this);
        }

        $this->objects[$name] = $class;

        return $class;
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

    public function has($name)
    {
        return isset($this->objects[$name]);
    }
}