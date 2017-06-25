<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $dossier_id
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereDossierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment whereUpdatedAt($value)
 */
class Payment extends Model
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
