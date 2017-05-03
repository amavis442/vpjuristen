<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property int $id
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Action $action
 * @property-read \App\Dossier $dossier
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    public function dossier()
    {
        return $this->belongsTo('App\Dossier');
    }
    
    public function action()
    {
        return $this->belongsTo('App\Action');
    }
}
