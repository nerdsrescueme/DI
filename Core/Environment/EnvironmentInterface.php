<?php

namespace Nerd\Core\Environment;

interface EnvironmentInterface
{
    public function getName();

    public function setName($name);
}