<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invoice
 *
 * @property int $id
 * @property int $dossier_id
 * @property float $amount
 * @property string $due_date
 * @property string $file
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Dossier $dossier
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereDossierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereDueDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    protected $fillable = [ 'dossier_id','amount','due_date','file','created_at','updated_at'];

    public function dossier()
    {
        return $this->belongsTo('App\Dossier');
    }
}
