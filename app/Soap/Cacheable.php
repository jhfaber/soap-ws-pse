<?php

namespace App\Soap;

/**
 * Interface Cacheable to make SOAP methods calls cacheable
 *
 * @package App\Soap
 */
interface Cacheable
{
    /**
     * Method called instead of execute for caching SOAP calls.
     *
     * @param $parameters
     * @return mixed
     */
    public function cache($parameters);
}