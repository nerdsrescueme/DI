<?php

namespace Nerd\Container;

trait Aware
{
    protected $container;

    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;

        return $this;
    }
}