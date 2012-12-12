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
        }

        return $object;
    }

    public function register($event, ListenerInterface $listener)
    {
        if (!isset($this->listeners[$event])) {
            $this->listeners[$event] = array();
        }

        $this->listeners[$event][] = $listener;

        return $this;
    }

    public function unregister($event, ListenerInterface $listener)
    {
        if ($this->has($event)) {
            foreach($this->get($event) as $key => $listenerComp) {
                if ($listenerComp === $listener) {
                    unset($this->listeners[$event][$key]);
                    return true;
                }
            }
        }

        return false;
    }

    public function get($event)
    {
        if (!isset($this->listeners[$event])) {
            return array();
        }

        return $this->listeners[$event];
    }

    public function has($event)
    {
        return isset($this->listeners[$event]) and count($this->listeners[$event]);
    }

    private function _dispatch($event, EventInterface $object)
    {
        $listeners = $this->get($event);

        usort($listeners, function($a, $b) {
            $a = $a->getPriority();
            $b = $b->getPriority();
            if ($a == $b) return 0;
            return ($a < $b) ? -1 : 1;
        });

        foreach ($listeners as $listener) {
            $listener($object);
            if ($object->isPropogationStopped()) {
                break;
            }
        }
    }
}