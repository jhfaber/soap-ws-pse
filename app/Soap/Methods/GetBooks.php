<?php

namespace App\Soap\Methods;

class GetBooks
{
    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * Method constructor.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Method that execute the actual SOAP call
     *
     * @return mixed
     */
    public function execute()
    {
        $response = $this->client->getBooks();

        return json_decode(json_encode($response->Books), true);
    }
}