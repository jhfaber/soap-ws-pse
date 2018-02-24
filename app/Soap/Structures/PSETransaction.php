<?php

namespace App\Soap\Structures;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PSETransaction
 * Support class only used to represent a SOAP structure in the application.
 *
 * @package App
 */
class PSETransaction extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * Is set empty so that all attributes can be mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Set the PSETransacttionRequest's total amount.
     *
     * @param  string  $value
     * @return void
     */
    public function setTotalAmountAttribute($value)
    {
        $this->attributes['totalAmount'] = (float) $value;
    }

    /**
     * Set the PSETransacttionRequest's tax amount.
     *
     * @param  string  $value
     * @return void
     */
    public function setTaxAmountAttribute($value)
    {
        $this->attributes['taxAmount'] = (float) $value;
    }

    /**
     * Set the PSETransacttion request's devolution base.
     *
     * @param  string  $value
     * @return void
     */
    public function setDevolutionBaseAttribute($value)
    {
        $this->attributes['devolutionBase'] = (float) $value;
    }

    /**
     * Set the PSETransacttionRequest's tip amount.
     *
     * @param  string  $value
     * @return void
     */
    public function setTipAmountAttribute($value)
    {
        $this->attributes['tipAmount'] = (float) $value;
    }
}
