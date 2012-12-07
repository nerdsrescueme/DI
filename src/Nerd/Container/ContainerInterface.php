<?php

namespace Nerd\Container;

interface ContainerInterface
{
    public function set($name, $class);

    public function delete($name);

    public function get($name);

    public function has($name);
}