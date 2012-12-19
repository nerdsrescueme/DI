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

    // Should this listener run?
    public function qualify(\SplSubject $event)
    {
        return true;
    }

    abstract public function run(\SplSubject $event);

    final public function __invoke(\SplSubject $event)
    {
        return $this->run($event);
    }
}