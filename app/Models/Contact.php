<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Contact
 *
 * @property int                                                                 $id
 * @property string                                                              $name
 * @property string                                                              $firstname
 * @property string|null                                                         $middlename
 * @property string                                                              $sexe
 * @property string|null                                                         $title
 * @property string|null                                                         $street
 * @property string|null                                                         $housenr
 * @property string|null                                                         $city
 * @property string|null                                                         $zipcode
 * @property string|null                                                         $country
 * @property string                                                              $phone
 * @property string                                                              $email
 * @property string|null                                                         $fax
 * @property string|null                                                         $remarks
 * @property \Carbon\Carbon|null                                                 $created_at
 * @property \Carbon\Carbon|null                                                 $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]    $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereHousenr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereMiddlename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contact whereZipcode($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{

    protected $fillable = [
        'company_id',
        'sexe',
        'firstname',
        'middlename',
        'name',
        'email',
        'phone',
        'postalcode',
        'street',
        'housenumber',
        'city',
        'fax',
        'country',
    ];
    const RULES = [
        'name'        => 'required|string|max:255',
        'street'      => 'required|string|max:255',
        'housenumber' => 'required|string|max:10',
        'postalcode'  => 'required|string|max:10',
        'city'        => 'required|string|max:255',
        'email'       => 'email',
        'website'     => 'max:255',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps(); // To use the pivot table even if there is a 1-1 relationship
    }

}
