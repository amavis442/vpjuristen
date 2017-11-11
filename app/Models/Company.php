<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Company
 *
 * @property int                                                                 $id
 * @property string                                                              $name
 * @property string|null                                                         $company
 * @property string|null                                                         $kvk
 * @property string                                                              $street
 * @property string                                                              $housenr
 * @property string                                                              $postcode
 * @property string                                                              $city
 * @property string|null                                                         $country
 * @property string                                                              $phone
 * @property string                                                              $email
 * @property string|null                                                         $website
 * @property string|null                                                         $iban
 * @property \Carbon\Carbon|null                                                 $created_at
 * @property \Carbon\Carbon|null                                                 $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dossier[] $dossiers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]    $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereHousenr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereKvk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereWebsite($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company client()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company debtor()
 */
class Company extends Model
{
    protected $fillable = ['name', 'street', 'housenumber', 'postalcode', 'city', 'country', 'phone', 'email', 'website'];

    const RULES = [
        'name'        => 'required|string|max:255',
        'street'      => 'required|string|max:255',
        'housenumber' => 'required|string|max:10',
        'postalcode'  => 'required|string|max:10',
        'city'        => 'required|string|max:255',
        'email'       => 'email',
        'website'     => 'max:255',
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)->withPivot('type')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getClients()
    {
        return $this->with(Dossier::class)->dossiers()->wherePivot('type', '=', 'client');
    }

    public function getDebtors()
    {
        return $this->with(Dossier::class)->dossiers()->wherePivot('type', '=', 'debtor');
    }

    public function scopeClient($query)
    {
        return $query->whereHas('dossiers', function ($query) {
            $query->where('type', '=', 'client');
        });
    }

    public function scopeDebtor($query)
    {
        return $query->whereHas('dossiers', function ($query) {
            $query->where('type', '=', 'debtor');
        });
    }
}
