<?php

namespace App\Policies;

use App\Domain\Contract\UserInterface;
use App\Models\User;
use App\Action;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Collection;

class ActionPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        // Admin and employee may see always
        if ($user->hasRole('admin') || $user->hasRole('employee')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the action.
     *
     * @param  \App\User $user
     * @param  \App\Action $action
     * @return mixed
     */
    public function view(User $user, Action $action)
    {
        /** @var Collection $roles */
        $roles = $user->roles()->get(['role_id']);//->values()->toArray();

       return true;

        return false;
    }

    /**
     * Determine whether the user can create actions.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the action.
     *
     * @param  \App\User $user
     * @param  \App\Action $action
     * @return mixed
     */
    public function update(User $user, Action $action)
    {
        /** @var Collection $roles */
        $roles = $user->roles()->get(['role_id']);//->values()->toArray();

        // May a lesser god see the action
        $actionRoles = $action->roles()->get(['role_id']);
        foreach ($roles as $role) {
            if ($actionRoles->where('role_id', $role->role_id)->first()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the action.
     *
     * @param  \App\User $user
     * @param  \App\Action $action
     * @return mixed
     */
    public function delete(User $user, Action $action)
    {
        return false;
    }
}
