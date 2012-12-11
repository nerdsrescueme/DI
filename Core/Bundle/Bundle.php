<?php

namespace Nerd\Core\Bundle;

abstract class Bundle
{
    public function getName()
    {
        return get_class();
    }

    public function initialize()
    {
        // Do nothing by default
    }
}