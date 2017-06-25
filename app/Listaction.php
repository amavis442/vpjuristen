<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 7:00 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Listaction
 *
 * @property int $id
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Action[] $actions
 * @method static \Illuminate\Database\Query\Builder|\App\Listaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Listaction whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Listaction whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Listaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Listaction extends Model
{
    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}