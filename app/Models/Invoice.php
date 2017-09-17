<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Support\Collection;

/**
 * App\Models\Invoice
 *
 * @property int                                                              $id
 * @property int                                                              $dossier_id
 * @property string|null                                                      $title
 * @property float                                                            $amount
 * @property string                                                           $due_date
 * @property string|null                                                      $remarks
 * @property \Carbon\Carbon|null                                              $created_at
 * @property \Carbon\Carbon|null                                              $updated_at
 * @property-read \App\Models\Dossier                                         $dossier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereDossierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 */
class Invoice extends Model implements HasMedia
{

    use HasMediaTrait;

    protected $fillable = ['title', 'remarks', 'amount', 'due_date'];

    /**
     * @param $dossier_id
     * @return Collection
     */
    public function getInvoicesByDossierId($dossier_id)
    : Collection {
        /** @var Collection $invoices */
        $invoices = Invoice::with('dossier')->where('dossier_id', $dossier_id)->get();

        return $invoices;
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
