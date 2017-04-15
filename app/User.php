<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Company[] $companies
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActive($value)
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStatus($value)
 */
class User extends Authenticatable
{

    use Notifiable;

    protected $guard = 'dashboard';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 'active';
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name) {
                return true;
            }
        }
        return false;
    }

    public function companies()
    {
        return $this->belongsToMany('App\Company')->withTimestamps();
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact');// To use the pivot table even if there is a 1-1 relationship
    }
}
