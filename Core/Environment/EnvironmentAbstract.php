<?php

namespace Nerd\Core\Environment;

abstract class EnvironmentAbstract implements EnvironmentInterface
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}