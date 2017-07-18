<?php

namespace Bart\Ab;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ab';
    }
}