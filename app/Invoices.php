<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invoices
 *
 * @property int $id
 * @property int $dossier_id
 * @property float $amount
 * @property string $due_date
 * @property string $file
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Dossier $dossier
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereDossierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereDueDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoices whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Invoices extends Model
{
    public function dossier()
    {
        return $this->belongsTo('App\Dossier');
    }
}
