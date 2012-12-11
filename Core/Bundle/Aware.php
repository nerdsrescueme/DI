<?php

namespace Nerd\Core\Bundle;

trait Aware
{
    protected $manager;

    public function getManager()
    {
        return $this->manager;
    }

    public function setManager(Manager $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    public function hasManager()
    {
        return $this->manager !== null;
    }
}