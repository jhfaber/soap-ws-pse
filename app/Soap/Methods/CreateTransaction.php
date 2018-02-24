<?php

namespace App\Soap\Methods;

use App\Soap\Auth;
use App\Soap\Structures\PSETransaction;

class CreateTransaction
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
     * @param \App\Soap\Structures\PSETransaction $transaction
     * @return array
     */
    public function execute(PSETransaction $transaction)
    {
        $response = $this->client->createTransaction([
            'auth' => $this->auth,
            'transaction' => $transaction
        ]);

        $response = $response->createTransactionResult;

        return (array) $response;
    }
}