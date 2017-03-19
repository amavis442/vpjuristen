<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Debtor
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Company $company
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Debtor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Debtor extends Model
{
    protected $fillable = ['updated_at', 'created_at'];


    public function company()
    {
        return $this->hasOne('App\Company');
    }
}
