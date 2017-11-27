<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Payment
 *
 * @property int                      $id
 * @property int                      $dossier_id
 * @property int                      $action_id
 * @property float                    $amount
 * @property int                      $public
 * @property \Carbon\Carbon|null      $created_at
 * @property \Carbon\Carbon|null      $updated_at
 * @property-read \App\Models\Action  $action
 * @property-read \App\Models\Dossier $dossier
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereDossierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
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
