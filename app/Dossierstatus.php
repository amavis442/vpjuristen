<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossierstatus extends Model
{
    protected $fillable = ['description', 'updated_at','created_at'];

    public function dossiers()
    {
        return $this->hasMany('App\Dossier');
    }
}
