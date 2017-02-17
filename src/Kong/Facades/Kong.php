<?php

namespace Ignittion\Kong\Facades;

use Illuminate\Support\Facades\Facade;

class Kong extends Facade
{
    /**
     * Get the registered name of the component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kong';
    }
}
