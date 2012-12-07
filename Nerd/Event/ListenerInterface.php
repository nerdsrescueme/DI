<?php

namespace Nerd\Event;

interface ListenerInterface
{
    public function getPriority();

    public function setPriority($priority);

    public function __invoke(EventInterface $event);
}