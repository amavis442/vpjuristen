<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * App\Models\Action
 *
 * @property int                                                                 $id
 * @property string                                                              $title
 * @property string                                                              $description
 * @property int                                                                 $listaction_id
 * @property string                                                              $status
 * @property int                                                                 $public
 * @property \Carbon\Carbon|null                                                 $created_at
 * @property \Carbon\Carbon|null                                                 $updated_at
 * @property-read \App\Models\Collection                                         $collection
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dossier[] $dossiers
 * @property-read \App\Models\Listaction                                         $listaction
 * @property-read \App\Models\Payment                                            $payment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereListactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Action extends Model
{
    protected $fillable = ['title', 'description', 'status', 'listaction_id', 'public'];

    public function comments()
    {
        return $this->belongsToMany(Comment::class)->withPivot('public')->withTimestamps();
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)->withPivot('public')->withTimestamps();
    }

    public function listaction()
    {
        return $this->belongsTo(Listaction::class);
    }

    /**
     * Received from debtor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function collection()
    {
        return $this->hasOne(Collection::class);
    }

    /**
     * Paid to client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
