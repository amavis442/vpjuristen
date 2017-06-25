<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $firstname
 * @property string $middlename
 * @property string $sexe
 * @property string $title
 * @property string $street
 * @property string $housenr
 * @property string $city
 * @property string $zipcode
 * @property string $country
 * @property string $phone
 * @property string $email
 * @property string $fax
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Client $client
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereFax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereHousenr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereMiddlename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereSexe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereZipcode($value)
 * @mixin \Eloquent
 * @property-read \App\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 */
class Contact extends Model
{
    protected $fillable = ['company_id', 'sexe','firstname','middlename','name',
                           'email', 'phone','zipcode','street','housenr','city',
                           'fax','country'];

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps(); // To use the pivot table even if there is a 1-1 relationship
    }

}
