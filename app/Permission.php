<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Permission
 *
 * @property int $id
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Model
{
    //
}
