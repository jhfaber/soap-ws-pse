<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'reference', 'transactionID', 'sessionID', 'trazabilityCode', 'responseCode', 'responseReasonText', 'transactionState'
    ];

    /**
     * The user that made the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
