<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Dossier
 *
 * @property int $id
 * @property int $client_id
 * @property int $debtor_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\Debtor $debtor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invoice[] $invoices
 * @method static \Illuminate\Database\Query\Builder|\App\Dossier whereClientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossier whereDebtorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossier whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dossier extends Model
{
    protected $fillable = ['client_id','debtor_id','title','created_at','updated_at'];

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function debtor()
    {
        return $this->hasOne('App\Debtor');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

}
