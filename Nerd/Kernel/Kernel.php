<?php

namespace Nerd\Kernel;

use Nerd\Event\DispatcherInterface as DI;
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
    protected $container;
    protected $root;
    protected $bundleData;

    public function __construct(DI $dispatcher, CI $container)
    {
        $this->dispatcher = $dispatcher;
        $this->container = $container;
    }

    public function getRoot()
    {
        return $this->directory;
    }

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

    public function getContainer()
    {
        return $this->container;
    }

    public function registerBundle($bundleName)
    {
        $loader = $this->container->get('loader');
        $path   = $this->getRoot()
            .DIRECTORY_SEPARATOR.'bundles'
            .DIRECTORY_SEPARATOR.strtolower($bundleName)
            .DIRECTORY_SEPARATOR.'src'
            .DIRECTORY_SEPARATOR;

        $loader->add(ucfirst($bundleName).'\\', $path);
        $bundle = ucfirst($bundleName).'\\Bundle';
        $bundle = new $bundle();
        $bundle->initialize();
        $this->bundleData[$bundleName] = $bundle;

        return $bundle;
    }
}