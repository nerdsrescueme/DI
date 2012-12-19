<?php

namespace Nerd\Core\Container\Tests;

use Nerd\Core\Container\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testSet()
    {
        $container = new Container;
        $class = new \stdClass;
        $this->assertSame($class, $container->set('sample', $class));
    }

    /**
     * @depends testSet
     */
    public function testGet()
    {
        $container = new Container;
        $class = new \stdClass;
        $container->set('sample', $class);
        $this->assertSame($class, $container->get('sample'));
        $this->assertSame($class, $container->sample);

        $class = new \stdClass;
        $container->sample2 = $class;
        $this->assertSame($class, $container->get('sample2'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetFails()
    {
        $container = new Container;
        $container->get('fail');
    }

    /**
     * @depends testSet
     */
    public function testHas()
    {
        $container = new Container;
        $class = new \stdClass();
        $container->set('sample', $class);
        $this->assertTrue($container->has('sample'));
    }

    /**
     * @depends testHas
     */
    public function testDelete()
    {
        $container = new Container;
        $container->set('sample1', new \stdClass());

        $this->assertTrue($container->delete('sample1'));
        $this->assertFalse($container->delete('sample1'));
        $this->assertFalse($container->has('sample1'));
    }

    public function testInheritance()
    {
        $container = new Container;
        $this->assertInstanceOf('Nerd\\Core\\Container\\ContainerInterface', $container);
    }
}