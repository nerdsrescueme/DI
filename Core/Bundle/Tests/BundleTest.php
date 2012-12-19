<?php

namespace Nerd\Core\Bundle\Tests;

use Nerd\Core\Bundle\Bundle;

class BundleTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
    	$bundle = new Bundle();
    	$this->assertTrue(is_object($bundle));
    }

    public function testNameDefaultBehavior()
    {
    	$bundle = new Bundle();
    	$this->assertSame('Nerd\\Core\\Bundle\\Bundle', $bundle->getName());
    }
}