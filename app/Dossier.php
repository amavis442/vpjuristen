<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function debtor()
    {
        return $this->hasOne('App\Debtor');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoices');
    }

}
