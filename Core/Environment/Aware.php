<?php

namespace Nerd\Core\Environment;

trait Aware
{
    protected $environment;

    public function getEnvironment()
    {
        if ($this->environment === null) {
            throw new \RuntimeException('Invalid access attempt, environment has not yet been set');
        }

        return $this->environment;
    }

    public function setEnvironment(EnvironmentInterface $environment)
    {
        $this->environment = $environment;

        return $this;
    }
}