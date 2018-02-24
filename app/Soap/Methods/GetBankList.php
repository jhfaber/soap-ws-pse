<?php

namespace App\Soap\Methods;

use App\Soap\Auth;
use App\Soap\Cacheable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GetBankList implements Cacheable
{
    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var \App\Soap\Auth
     */
    protected $auth;

    /**
     * Method constructor.
     *
     * @param $client
     * @param \App\Soap\Auth $auth
     */
    public function __construct($client, Auth $auth)
    {
        $this->client = $client;
        $this->auth = $auth;
    }

    /**
     * Method that execute the actual SOAP call
     *
     * @return mixed
     */
    public function execute()
    {



    }

    /**
     * Method called instead of execute for caching SOAP calls.
     *
     * @param $parameters
     * @return mixed
     */
    public function cache($parameters)
    {
        $response = Cache::remember('PlacetoPay.getBankList', 24*60, function () use ($parameters) {
            return call_user_func_array([$this, 'execute'], $parameters);
        });

        return $response;
    }
}