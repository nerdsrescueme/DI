<?php

namespace Nerd\Environment;

class Manager implements \Iterator
{
    protected $environments = [];
    protected $active;

    public function __construct(array $environments = array())
    {
        if (count($environments)) {
            foreach ($environments as $environment) {
                $this->registerEnvironment($environment);
            }
        }
    }

    public function setActive($name)
    {
        if (!$this->hasEnvironment($name)) {
            throw new \InvalidArgumentException("Environment [$name] is not registered, it cannot be set as active");
        }

        $this->active = &$this->environments[$name];

        return $this;
    }

    public function getActive()
    {
        if ($this->active === null) {
            throw new \RuntimeException('No environments have been set, so none can be active');
        }

        return $this->active;
    }

    // sets first registered environment as active
    public function registerEnvironment(EnvironmentInterface $environment)
    {
        $this->environments[$environment->getName()] = $environment;

        if ($this->active === null) {
            $this->setActive($environment->getName());
        }

        return $this;
    }

    public function registerEnvironments(array $environments)
    {
        foreach ($environments as $environment) {
            $this->registerEnvironment($environment);
        }

        return $this;
    }

    public function unregisterEnvironment($name)
    {
        if ($this->hasEnvironment($name)) {
            if ($this->active->getName() === $name) {
                throw new \RuntimeException("Environment [$name] is active, so it cannot be unregistered");
            }

            unset($this->environments[$name]);
            return true;
        }

        return false;
    }

    public function getEnvironment($name)
    {
        if (!$this->hasEnvironment($name)) {
            throw new \InvalidArgumentException("Environment [$name] is not registered with the environment manager");
        }

        return $this->environments[$name];
    }

    public function hasEnvironment($name)
    {
        return isset($this->environments[$name]);
    }


    /* ITERATOR METHODS
     * ================ */

    public function current()
    {
        return current($this->environments);
    }

    public function key()
    {
        return key($this->environments);
    }

    public function next()
    {
        return next($this->environments);
    }

    public function rewind()
    {
        return reset($this->environments);
    }

    public function valid()
    {
        return key($this->environments) !== null;
    }
}