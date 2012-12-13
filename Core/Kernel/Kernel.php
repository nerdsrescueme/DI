<?php

namespace Nerd\Core\Kernel;

use Nerd\Core\Event\DispatcherInterface as DI
  , Nerd\Core\Container\ContainerInterface as CI
  , Nerd\Core\Environment\Environment;

class Kernel implements KernelInterface
{
    protected $dispatcher;
    protected $container;
    protected $root;
    protected $bundleData;
    protected $environment;

    public function __construct(DI $dispatcher, CI $container)
    {
        $this->dispatcher = $dispatcher;
        $this->container = $container;

        // All errors treated as exceptions
        set_error_handler(function ($no, $str, $file, $line) {
            throw new \ErrorException($str, $no, 0, $file, $line);
        });

        // Register exception handler
        set_exception_handler(function($e) use ($dispatcher, $container) {
            $event = new \Nerd\Core\Event\Event('exception', $dispatcher);
            $event->exception = $e;
            $event->container = $container;

            $dispatcher->dispatch('exception', $event);
        });
    }

	public function getEnvironment()
	{
		return $this->environment;
	}

	public function setEnvironment(Environment $environment)
	{
		$this->environment = $environment;
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