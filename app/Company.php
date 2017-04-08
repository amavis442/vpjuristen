<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Company
 *
 * @property int $id
 * @property int $client_id
 * @property int $debtor_id
 * @property string $name
 * @property string $company
 * @property string $kvk
 * @property string $street
 * @property string $housenr
 * @property string $postcode
 * @property string $city
 * @property string $country
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property string $iban
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @property-read \App\Debtor $debtor
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereClientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereDebtorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereHousenr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereIban($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereKvk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company wherePostcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereWebsite($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Dossier[] $dossiers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 */
class Company extends Model
{
    protected $fillable = ['name', 'company', 'street', 'housenr', 'postcode', 'city', 'country', 'phone', 'email', 'website', 'updated_at', 'created_at'];


    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function dossiers()
    {
        return $this->belongsToMany('App\Dossier');
    }
}
