<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Client
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Company $company
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $company_id
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCompanyId($value)
 */
class Client extends Model
{
    protected $fillable = ['company_id','updated_at', 'created_at'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
