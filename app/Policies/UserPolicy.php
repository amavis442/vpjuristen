<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $currentUser, User $user)
    {
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\Models\User  $currentUser
     * @return mixed
     */
    public function create(User $currentUser)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $currentUser, UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User $currentUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $currentUser, User $user)
    {
        //
    }
}
