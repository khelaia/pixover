<?php

namespace khelaia\pixover\Facades;

use Illuminate\Support\Facades\Facade;

class pixover extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pixover';
    }
}
