<?php

namespace Nerd\Event;

interface DispatcherInterface
{
    public function dispatch($event, EventInterface $object = null);

    public function register($event, ListenerInterface $listener);

    public function unregister($event, ListenerInterface $listener);

    public function get($event);

    public function has($event);
}