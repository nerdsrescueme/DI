<?php

namespace Nerd\Core\Environment;

abstract class EnvironmentAbstract implements EnvironmentInterface
{
    protected $name;

    public function __construct($name)
    {
        $this->setName($name);
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
}