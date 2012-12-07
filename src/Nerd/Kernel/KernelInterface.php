<?php

namespace Nerd\Kernel;

interface KernelInterface
{
    public function getContainer();

    public function getDispatcher();
}