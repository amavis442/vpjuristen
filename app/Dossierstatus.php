<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Dossierstatus
 *
 * @property int $id
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Dossier[] $dossiers
 * @method static \Illuminate\Database\Query\Builder|\App\Dossierstatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossierstatus whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossierstatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dossierstatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dossierstatus extends Model
{
    protected $fillable = ['description', 'updated_at','created_at'];

    public function dossiers()
    {
        return $this->hasMany('App\Dossier');
    }
}
