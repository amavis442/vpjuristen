<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Action
 *
 * @property int $id
 * @property string $listactions_id
 * @property string $status
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereListactionsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Dossier $dossier
 * @property-read \App\Listaction $listaction
 * @property string $listaction_id
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereListactionId($value)
 */
class Action extends Model
{
    public function dossier()
    {
        return $this->belongsToMany('App\Dossier');
    }


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function comments()
    {
        return $this->belongsToMany('App\Comment');
    }

    public function listaction()
    {
        return $this->belongsTo('App\Listaction');
    }

    public function collection()
    {
        return $this->hasOne('App\Collection');
    }
}
