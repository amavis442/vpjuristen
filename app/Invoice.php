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
 * @property string $title
 * @property string $remarks
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTitle($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\File[] $files
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\File[] $invoiceFiles
 */
class Invoice extends Model
{
    protected $fillable = ['dossier_id', 'title', 'remarks', 'amount', 'due_date', 'created_at', 'updated_at'];

    public function dossier()
    {
        return $this->belongsTo('App\Dossier');
    }

    public function files()
    {
        return $this->belongsToMany('App\File');
    }
}
