<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auth extends Model
{
    protected $fillable = [

        'name',
        'value',



    ];
    public function transactionID(){


        return $this->belongsTo('App\transactionID');


    }

}
