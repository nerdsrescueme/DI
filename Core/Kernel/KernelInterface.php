<?php

namespace Nerd\Core\Kernel;

interface KernelInterface
{
    public function getContainer();

    public function getDispatcher();
}