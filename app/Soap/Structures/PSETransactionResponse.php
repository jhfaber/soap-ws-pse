<?php

namespace App\Soap\Structures;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PSETransactionResponse
 * Support class only used to represent a SOAP structure in the application.
 *
 * @package App\Soap\Structures
 */
class PSETransactionResponse extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * Is set empty so that all attributes can be mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
