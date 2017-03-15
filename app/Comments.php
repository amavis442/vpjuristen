<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function dossier()
    {
        return $this->belongsTo('App\Dossier');
    }
    
    public function action()
    {
        return $this->hasOne('App\Action');
    }
}
