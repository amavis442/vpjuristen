<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $comment
 * @property int $public
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dossier[] $dossiers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $fillable = ['comment','public'];

    public function actions()
    {
        return $this->belongsToMany(Action::class)->withPivot('public')->withTimestamps();
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)->withPivot('public')->withTimestamps();
    }

}
