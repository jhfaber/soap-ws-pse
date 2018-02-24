<?php

namespace App\Soap;

/**
 * Class Auth responsible of generating correct authentication data
 * for SOAP WebService
 *
 * @package App\Soap
 */
class Auth
{
    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $tranKey;

    /**
     * @var string
     */
    private $seed;

    /**
     * @var array
     */
    protected $additional;

    /**
     * Auth constructor.
     *
     * @param $login
     * @param $tranKey
     * @param array $additional
     */
    public function __construct($login, $tranKey, array $additional = [])
    {
        $this->login = $login;
        $this->tranKey = $this->generateHash($tranKey);
        $this->additional = $additional;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
    /**
     * @return string
     */
    public function getTranKey()
    {
        return $this->tranKey;
    }

    /**
     * @return string
     */
    public function getSeed()
    {
        return $this->seed;
    }

    /**
     * @return array
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * @param string $tranKey
     * @return string
     */
    private function generateHash($tranKey)
    {
        $this->seed = date('c');
        return sha1($this->seed.$tranKey, false);
    }

    /**
     * return an array with the attributes needed to authenticate.
     *
     * @return array
     */
    public function getCredentials()
    {
        return [
            'login' => $this->getLogin(),
            'tranKey' => $this->getTranKey(),
            'seed' => $this->getSeed(),
            'additional' => $this->getAdditional(),
        ];
    }
}