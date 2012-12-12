<?php

namespace Nerd\Core\Event;

abstract class ListenerAbstract implements ListenerInterface
{
    protected $priority = 0;

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        // This check is only in place until scalar type hinting...
        if (!is_int($priority)) {
            throw new \InvalidArgumentException('Priority must be an integer');
        }

        $this->priority = $priority;

        return $this;
    }

    // Must return the event object in case of alterations...
    public function __invoke(EventInterface $event)
    {
        echo 'LISTENER FIRED<br>'.PHP_EOL;
    }
}