<?php

namespace App\Soap\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PlacetoPay to take advantage of Laravel Container
 *
 * @package App\Soap\Facades
 */
class PlacetoPay extends Facade
{
    public static function getFacadeAccessor()
    {
        return PlacetoPay::class;
    }


    public function getBankList(){

    }
}