<?php

namespace App\Soap;

use Exception;

/**
 * Class Consumer responsible of connecting and interact with the SOAP WebService
 *
 * @package App\Soap
 */
class Consumer
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
     * Consumer constructor.
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
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param \App\Soap\Auth $auth
     */
    public function setAuth(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Magic method that maps to instantiating and calling the correct method in the correct class,
     * depending on the method dynamically called.
     * E.g. getBooks => (new GetBooks)->execute() or cache() if its cacheable.
     *
     * @param $method
     * @param $parameters
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        if (! class_exists($class = $this->getClassNameFromMethod($method))) {
            throw new Exception("Method {$method} does not exist");
        }

        $instance = new $class($this->client, $this->auth);

        if ($instance instanceof Cacheable) {
            return $instance->cache($parameters);
        }

        // Delegate the handling of this method call to the appropriate class
        return call_user_func_array([$instance, 'execute'], $parameters);
    }

    /**
     * Get class name that handles execution of this method
     *
     * @param $method
     * @return string
     */
    private function getClassNameFromMethod($method)
    {
        return 'App\\Soap\\Methods\\' . ucwords($method);
    }
}