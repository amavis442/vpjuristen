<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\File
 *
 * @property int $id
 * @property string $filename
 * @property string $filename_org
 * @property int $invoice_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Invoice $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFilenameOrg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $fillable = ['filename','filename_org'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
