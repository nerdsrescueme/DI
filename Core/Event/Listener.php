<?php

namespace Nerd\Core\Event;

class Listener implements ListenerInterface
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
            throw new \InvalidArgumentException('Argument 1 must be of type integer');
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