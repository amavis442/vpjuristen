<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class Action extends Model
{
    public function comments()
    {
        return $this->belongsToMany('App\Comment');
    }
}
