<?php

namespace Nerd\Bundle;

use Nerd\Container\Aware as ContainerAware;

class Manager implements \Iterator
{
    use ContainerAware;

    protected $bundles = [];

    // sets first registered bundle as active
    public function register(Bundle $bundle)
    {
        $name   = $bundle->getName();

        if ($this->has($name)) {
            throw new \RuntimeException("Bundle [$name] has already been registered");
        }

        // Inject the manager into bundle instance.
        $bundle->setManager($this);
        $this->bundles[$name] = $bundle;

        return $this;
    }

    public function registerMultiple(array $bundles)
    {
        foreach ($bundles as $bundle) {
            $this->register($bundle);
        }

        return $this;
    }

    public function unregister($name)
    {
        if ($this->hasBundle($name)) {
            unset($this->bundles[$name]);
            return true;
        }

        return false;
    }

    public function get($name)
    {
        if (!$this->hasBundle($name)) {
            throw new \InvalidArgumentException("Bundle [$name] is not registered with the bundle manager");
        }

        return $this->bundles[$name];
    }

    public function has($name)
    {
        return isset($this->bundles[$name]);
    }


    /* ITERATOR METHODS
     * ================ */

    public function current()
    {
        return current($this->bundles);
    }

    public function key()
    {
        return key($this->bundles);
    }

    public function next()
    {
        return next($this->bundles);
    }

    public function rewind()
    {
        return reset($this->bundles);
    }

    public function valid()
    {
        return key($this->bundles) !== null;
    }
}