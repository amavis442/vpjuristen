<?php

namespace App\Models;

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
 * @property int $action_id
 * @property int $public
 * @property-read \App\Models\Action $action
 * @property-read \App\Models\Dossier $dossier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePublic($value)
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
