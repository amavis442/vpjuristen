<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lab404\Impersonate\Models\Impersonate;


/**
 * App\Models\User
 *
 * @property int                                                                                                            $id
 * @property string                                                                                                         $name
 * @property string                                                                                                         $email
 * @property string                                                                                                         $password
 * @property int                                                                                                            $active
 * @property string|null                                                                                                    $remember_token
 * @property \Carbon\Carbon|null                                                                                            $created_at
 * @property \Carbon\Carbon|null                                                                                            $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[]                                            $companies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[]                                            $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dossier[]                                            $dossiers
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[]                                               $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string                                                                                                         $username
 * @property string                                                                                                         $role
 * @property string                                                                                                         $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 */
class User extends Authenticatable
{

    use Notifiable, Impersonate;

    const RULES = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ];

    const ROLES = ['guest', 'user', 'employee', 'manager', 'admin'];

    const STATUS = ['pending', 'active', 'disabled'];

    //protected $guard = 'dashboard';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();// To use the pivot table even if there is a 1-1 relationship
    }

    public function dossiers()
    {
        return $this->belongsToMany(Dossier::class)->withPivot('type')->withTimestamps();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 'active';
    }

    public function isPending()
    {
        return $this->status == 'pending';
    }

    public function isDisabled()
    {
        return $this->status == 'disabled';
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isUser()
    {
        return $this->role == 'user';
    }

    public function isEmployee()
    {
        return $this->role == 'employee';
    }

    public function isManager()
    {
        return $this->role == 'manager';
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin();
    }


    public function isAdmin()
    {
        return $this->role == 'admin';
    }
}
