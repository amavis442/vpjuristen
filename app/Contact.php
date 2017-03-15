<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
