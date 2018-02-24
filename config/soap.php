<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Web Service SOAP WSDL
    |--------------------------------------------------------------------------
    |
    | This value is the URL address of the Web Service WSDL.
    |
    */
    'wsdl' => env('SOAP_WSDL', '​https://test.placetopay.com/soap/pse/?wsdl'),

    /*
    |--------------------------------------------------------------------------
    | Web Service SOAP address
    |--------------------------------------------------------------------------
    |
    | This value is the URL address of the Web Service location. All requests
    | will be made to this endpoint.
    |
    */
    'location' => env('SOAP_LOCATION', '​https://test.placetopay.com/soap/pse/'),

    /*
    |--------------------------------------------------------------------------
    | Web Service SOAP login
    |--------------------------------------------------------------------------
    |
    | This value is the enabled identifier for the API consumption.
    | This is given by the owner of the Web Service.
    |
    */
    'login' => env('SOAP_LOGIN', '6dd490faf9cb87a9862245da41170ff2'),

    /*
    |--------------------------------------------------------------------------
    | Web Service SOAP transactional key
    |--------------------------------------------------------------------------
    |
    | This value is the transactional key, given by the owner of the Web Service,
    | for the API consumption
    |
    */
    'tranKey' => env('SOAP_TRAN_KEY', '024h1IlD'),

];
