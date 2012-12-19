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

        if ($this->has($event)) {
            $this->_dispatch($event, $object);
        } else {
            throw new \InvalidArgumentException("Dispatcher does not contain the [$event] event type");
        }

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
        return $this->has($event) ? $this->listeners[$event] : null;
    }

    public function has($event)
    {
        return isset($this->listeners[$event]);
    }

    private function _dispatch($event, EventInterface $object)
    {
        $listeners = [];

        foreach($this->get($event) as $listener) {
            $listeners[$listener->getPriority().'-'.get_class($listener)] = $listener;
        }

        foreach (ksort($listeners, SORT_NATURAL) as $listener) {
            $listener->qualify($object) and $listener($object);
            if ($object->isPropogationStopped()) {
                break;
            }
        }
    }
}