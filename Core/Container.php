<?php

namespace Core;

use Exception;

class Container
{
    protected $bindings = [];

    public function bind($key, $factory)
    {
        $this->bindings[$key] = $factory;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $factory = $this->bindings[$key];

        return call_user_func($factory);
    }
}