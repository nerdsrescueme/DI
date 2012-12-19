<?php

namespace Nerd\Core\Environment\Tests;

use Nerd\Core\Environment\Environment;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
	public function testName()
	{
		$env = new Environment('test');
		$this->assertSame('test', $env->getName());
	}

    public function testInheritance()
    {
    	$env = new Environment('test');
    	$this->assertInstanceOf('Nerd\\Core\\Environment\\EnvironmentAbstract', $env);
    	$this->assertInstanceOf('Nerd\\Core\\Environment\\EnvironmentInterface', $env);
    }
}