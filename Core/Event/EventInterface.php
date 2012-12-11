<?php

namespace Nerd\Core\Event;

interface EventInterface
{
    public function __construct($name, DispatcherInterface $dispatcher);

    public function getDispatcher();

    public function getName();

    public function isPropogationStopped();

    public function stopPropogation();
}