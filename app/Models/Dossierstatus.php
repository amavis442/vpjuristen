<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Dossierstatus
 *
 * @property int                                                                 $id
 * @property string                                                              $description
 * @property \Carbon\Carbon|null                                                 $created_at
 * @property \Carbon\Carbon|null                                                 $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dossier[] $dossiers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossierstatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossierstatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossierstatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossierstatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dossierstatus extends Model
{
    protected $fillable = ['description'];

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
}
