<?php

namespace App\Soap\Methods;

use App\Soap\Auth;

class GetTransactionInformation
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
     * @param $transactionID
     * @return array
     */
    public function execute($transactionID)
    {
        $response = $this->client->getTransactionInformation([
            'auth' => $this->auth,
            'transactionID' => $transactionID
        ]);

        $response = $response->getTransactionInformationResult;

        return (array) $response;
    }
}