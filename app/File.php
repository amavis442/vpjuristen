<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\File
 *
 * @property int $id
 * @property string $filename
 * @property string $filename_org
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereFilenameOrg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Invoice $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invoice[] $invoices
 */
class File extends Model
{
    protected $fillable = ['filename','filename_org'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
