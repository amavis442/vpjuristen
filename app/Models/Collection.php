<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Collection
 *
 * @property int $id
 * @property int $dossier_id
 * @property int $action_id
 * @property float $amount
 * @property int $public
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Action $action
 * @property-read \App\Models\Dossier $dossier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereDossierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Collection extends Model
{
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
