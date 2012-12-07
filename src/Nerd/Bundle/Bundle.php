<?php

namespace Nerd\Bundle;

class Bundle
{
    use Aware;

    // Bundle events
    const START = 'bundle.start';
    const END   = 'bundle.end';

    public function getName()
    {
        return get_class();
    }
}