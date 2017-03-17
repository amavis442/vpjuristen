<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Client
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @mixin \Eloquent
 */
class Client extends Model
{

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

}
