<?php

namespace Nerd\Container;

interface ContainerInterface
{
    public function set($class, $name);

    public function delete($name);

    public function get($name);

    public function has($name);
}