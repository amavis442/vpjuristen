<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'company', 'street', 'housenr', 'postcode', 'city', 'country', 'phone', 'email', 'website', 'updated_at', 'created_at'];


    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function debtor()
    {
        return $this->belongsTo('App\Debtor');
    }
}
