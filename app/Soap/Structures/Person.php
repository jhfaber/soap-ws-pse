<?php

namespace App\Soap\Structures;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * Support class only used to represent a SOAP structure in the application.
 *
 * @package App
 */
class Person extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * Is set empty so that all attributes can be mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
