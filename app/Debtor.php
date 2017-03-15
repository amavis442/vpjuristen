<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{

    public function client()
    {
        return $this->hasOne('App\Client');
    }
 
}
