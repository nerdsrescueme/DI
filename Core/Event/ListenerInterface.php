<?php

namespace Nerd\Core\Event;

interface ListenerInterface
{
    public function getPriority();

    public function setPriority($priority);

    public function qualify(\SplSubject $event);

    public function run(\SplSubject $event);

    public function __invoke(\SplSubject $event);
}