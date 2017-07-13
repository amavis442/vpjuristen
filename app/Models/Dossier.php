<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Dossier
 *
 * @property int $id
 * @property string $title
 * @property int $dossierstatus_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read \App\Models\Dossierstatus $dossierstatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossier whereDossierstatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossier whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dossier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dossier extends Model
{
    protected $fillable = ['title', 'client_id', 'debtor_id', 'dossierstatus_id'];

    public function actions()
    {
        return $this->belongsToMany(Action::class)->withPivot('public')->withTimestamps();
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class)->withPivot('public')->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot('type')->withTimestamps();
    }

    public function collections()
    {
        $this->hasMany(Collection::class);
    }

    public function dossierstatus()
    {
        return $this->belongsTo(Dossierstatus::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        $this->hasMany(Payment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('type')
                    ->withTimestamps();
    }
}
