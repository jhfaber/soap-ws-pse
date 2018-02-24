<?php

namespace App\Providers;

use App\Soap\Auth;
use App\Soap\Facades\Auth as SoapAuth;
use App\Soap\Consumer;
use App\Soap\Facades\PlacetoPay;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register an Auth for the SOAP WebService
         */
        $this->app->bind(SoapAuth::class, function ($app) {
            return new Auth(config('soap.login'), config('soap.tranKey'));
        });

        /*
         * Register a Consumer to connect to the SOAP WebService
         */
        $this->app->bind(PlacetoPay::class, function ($app) {
            $wsdl = config('soap.wsdl');
            $location = config('soap.location');

            $client = new \SoapClient($wsdl, [
                'trace' => true,
                'cache' => WSDL_CACHE_NONE,
                'location' => $location,
            ]);

            return new Consumer($client, $app->make(SoapAuth::class));
        });
    }
}
