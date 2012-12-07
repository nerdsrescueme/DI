<?php

namespace Nerd\Kernel;

use Nerd\Event\DispatcherInterface as DI;
use Nerd\Bundle\Manager as BM;
use Nerd\Container\ContainerInterface as CI;

class Kernel implements KernelInterface
{
    // Kernel events
    const START    = 'kernel.start';
    const REQUEST  = 'kernel.request';
    const DISPATCH = 'kernel.dispatch';
    const RESPONSE = 'kernel.response';
    const PRESENT  = 'kernel.present';
    const END      = 'kernel.end';

    protected $dispatcher;
    protected $bundles;
    protected $container;
    protected $root;

    public function __construct(DI $dispatcher, BM $bundles, CI $container)
    {
        $this->dispatcher = $dispatcher;
        $this->bundles = $bundles->setContainer($container);
        $this->container = $container;
    }

    public function getDirectory()
    {
        return $this->directory;
    }

    // Where bundles are located.
    public function setRoot($directory)
    {
        if (!is_dir($directory)) {
            throw new \InvalidArgumentException("Directory [$directory] does not exist");
        }

        $this->directory = $directory;

        return $this;
    }

    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function getBundles()
    {
        return $this->bundles;
    }

    public function registerBundle($bundle)
    {
        $this->bundles->register($bundle);
    }

    public function getContainer()
    {
        return $this->container;
    }
}