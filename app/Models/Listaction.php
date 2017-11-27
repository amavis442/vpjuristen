<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 7:00 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Listaction
 *
 * @property int                                                                $id
 * @property string                                                             $description
 * @property \Carbon\Carbon|null                                                $created_at
 * @property \Carbon\Carbon|null                                                $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Action[] $actions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Listaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Listaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Listaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Listaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Listaction extends Model
{
    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}