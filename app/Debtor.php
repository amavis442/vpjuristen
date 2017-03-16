<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Debtor
 *
 * @property int $id
 * @property int $client_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Client $client
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereClientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Debtor extends Model
{

    public function client()
    {
        return $this->hasOne('App\Client');
    }
 
}
