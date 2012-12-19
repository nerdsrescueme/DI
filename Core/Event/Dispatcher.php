<?php

namespace Nerd\Core\Event;

class Dispatcher implements DispatcherInterface
{
    protected $listeners = [];

    public function dispatch($event, EventInterface $object = null)
    {
        if ($object === null) {
            $object = new Event($event, $this);
        }

        $this->_dispatch($event, $object);

        return $object;
    }

    public function attach($event, ListenerInterface $listener)
    {
        if (!$this->has($event)) {
            $this->listeners[$event] = new \SplObjectStorage;
        }

        $this->listeners[$event]->attach($listener);

        return $this;
    }

    public function detach($event, ListenerInterface $listener)
    {
        if ($this->has($event) and $this->get($event)->contains($listener)) {
            $this->get($event)->detach($listener);
            return true;
        }

        return false;
    }

    public function get($event)
    {
        return $this->has($event) ? $this->listeners[$event] : [];
    }

    public function has($event)
    {
        return isset($this->listeners[$event]);
    }

    private function _sortListeners($input)
    {
        $listeners = [];

        foreach($input as $listener) {
            $listeners[$listener->getPriority().'-'.get_class($listener)] = $listener;
        }

        ksort($listeners, SORT_NATURAL);

        return $listeners;
    }

    private function _dispatch($event, EventInterface $object)
    {
        $listeners = $this->_sortListeners($this->get($event));

        foreach ($listeners as $listener) {
            $listener->qualify($object) and $listener($object);
            if ($object->isPropogationStopped()) {
                break;
            }
        }
    }
}