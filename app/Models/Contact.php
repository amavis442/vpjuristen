<?php

namespace App\Models;

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
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereFax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereHousenr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereMiddlename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereSexe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereZipcode($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
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
