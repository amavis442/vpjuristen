<?php

namespace App\Policies;

use App\Domain\Contract\UserInterface;
use App\User;
use App\Action;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Collection;

class ActionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the action.
     *
     * @param  \App\User  $user
     * @param  \App\Action  $action
     * @return mixed
     */
    public function view(UserInterface $user, Action $action)
    {
        /** @var Collection $roles */
        $roles = $user->roles()->get(['role_id']);//->values()->toArray();

        // May a lesser god see the action
        $actionRoles = $action->roles()->get(['role_id']);
        foreach ($roles as  $role) {
            if ($actionRoles->where('role_id', $role->role_id)->first()) {
                return true;
            }
        }

        // Admin and employee may see always
        if ($user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('employee')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create actions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(UserInterface $user)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('employee')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the action.
     *
     * @param  \App\User  $user
     * @param  \App\Action  $action
     * @return mixed
     */
    public function update(UserInterface $user, Action $action)
    {
        /** @var Collection $roles */
        $roles = $user->roles()->get(['role_id']);//->values()->toArray();

        // May a lesser god see the action
        $actionRoles = $action->roles()->get(['role_id']);
        foreach ($roles as  $role) {
            if ($actionRoles->where('role_id', $role->role_id)->first()) {
                return true;
            }
        }

        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('employee')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the action.
     *
     * @param  \App\User  $user
     * @param  \App\Action  $action
     * @return mixed
     */
    public function delete(UserInterface $user, Action $action)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        /*
        if ($user->hasRole('employee')) {
            return true;
        }*/

        return false;
    }
}
