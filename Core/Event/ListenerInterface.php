<?php

namespace Nerd\Core\Event;

interface ListenerInterface
{
    public function getPriority();

    public function setPriority($priority);

    public function qualify(EventInterface $event);

    public function __invoke(EventInterface $event);
}