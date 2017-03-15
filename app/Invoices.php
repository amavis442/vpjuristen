<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    public function dossier()
    {
        return $this->belongsTo('App\Dossier');
    }
}
