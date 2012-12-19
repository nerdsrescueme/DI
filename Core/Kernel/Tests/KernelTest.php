<?php

namespace Nerd\Core\Kernel\Tests;

use Nerd\Core\Kernel\Kernel;

class KernelTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
    	$kernel = new Kernel;
    	$this->assertInstanceOf('Nerd\\Core\\Kernel\\KernelInterface', $kernel);
    }

    public function testContainer()
    {
    	$container = new \Nerd\Core\Container\Container;
    	$kernel = new Kernel(null, $container);
    	$this->assertSame($container, $kernel->getContainer());
    }

    public function testDispatcher()
    {
    	$dispatcher = new \Nerd\Core\Event\Dispatcher;
    	$kernel = new Kernel($dispatcher);
    	$this->assertSame($dispatcher, $kernel->getDispatcher());
    }

    /**
     * Test environment setting, getting and chaining
     */
    public function testEnvironment()
    {
    	$env = new \Nerd\Core\Environment\Environment('test');
    	$kernel = new Kernel;
    	$this->assertSame($kernel, $kernel->setEnvironment($env));
    	$this->assertSame($env, $kernel->getEnvironment());
    }

    public function testRoot()
    {
    	$kernel = new Kernel;
    	$this->assertSame($kernel, $kernel->setRoot(__DIR__));
    	$this->assertSame(__DIR__, $kernel->getRoot());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Directory [/path/fails] does not exist
     */
    public function testRootInvalidDirFails()
    {
    	$kernel = new Kernel;
    	$kernel->setRoot('/path/fails');
    }
}