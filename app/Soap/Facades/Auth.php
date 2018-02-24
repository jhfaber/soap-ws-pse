<?php

namespace App\Soap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Auth to take advantage of Laravel Container
 *
 * @package App\Soap\Facades
 */
class Auth extends Facade
{
    public static function getFacadeAccessor()
    {
        return \App\Soap\Auth::class;
    }
}