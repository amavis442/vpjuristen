<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Collection
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $dossier_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Collection whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Collection whereDossierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Collection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Collection whereUpdatedAt($value)
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
