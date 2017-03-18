<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Client
 *
 * @property int $id
 * @property string $name
 * @property string $company
 * @property string $street
 * @property string $housenr
 * @property string $postcode
 * @property string $city
 * @property string $country
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereHousenr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client wherePostcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereWebsite($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $fillable = ['name', 'company', 'street', 'housenr', 'postcode', 'city', 'country', 'phone', 'email', 'website', 'updated_at', 'created_at'];


    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

}
