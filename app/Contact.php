<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact
 *
 * @property int $id
 * @property int $client_id
 * @property string $name
 * @property string $surname
 * @property string $middlename
 * @property string $sexe
 * @property string $title
 * @property string $street
 * @property string $housenr
 * @property string $place
 * @property string $zipcode
 * @property string $country
 * @property string $phone
 * @property string $email
 * @property string $fax
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Client $client
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereClientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereFax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereHousenr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereMiddlename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereSexe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereSurname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereZipcode($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
