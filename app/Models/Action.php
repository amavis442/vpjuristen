<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Action
 *
 * @property int $id
 * @property string $listactions_id
 * @property string $status
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereListactionsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Dossier $dossier
 * @property-read \App\Listaction $listaction
 * @property string $listaction_id
 * @method static \Illuminate\Database\Query\Builder|\App\Action whereListactionId($value)
 * @property int $public
 * @property-read \App\Models\Collection $collection
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dossier[] $dossiers
 * @property-read \App\Models\Payment $payment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Action wherePublic($value)
 */
class Action extends Model
{
    protected $fillable = ['title','description','status','listaction_id','public'];

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
