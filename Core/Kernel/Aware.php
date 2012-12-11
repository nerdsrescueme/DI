<?php

namespace Nerd\Core\Kernel;

trait Aware
{
    protected $kernel;

    public function getKernel()
    {
        return $this->kernel;
    }

    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;

        return $this;
    }
}