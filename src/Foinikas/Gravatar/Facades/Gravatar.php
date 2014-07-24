<?php namespace Foinikas\Gravatar\Facades;

use Illuminate\Support\Facades\Facade;

class Gravatar extends Facade {

    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Gravatar';
    }

} 