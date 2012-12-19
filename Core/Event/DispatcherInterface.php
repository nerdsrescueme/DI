<?php

namespace Nerd\Core\Event;

interface DispatcherInterface
{
    public function dispatch($event, EventInterface $object = null);

    public function attach($event, ListenerInterface $listener);

    public function detach($event, ListenerInterface $listener);

    public function get($event);

    public function has($event);
}