<?php

namespace App\Policies;

use App\Domain\Contract\UserInterface;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Domain\Contract\UserInterface  $currentUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $currentUser, User $user)
    {
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\Domain\Contract\UserInterface  $currentUser
     * @return mixed
     */
    public function create(User $currentUser)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Domain\Contract\UserInterface  $currentUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $currentUser, UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Domain\Contract\UserInterface  $currentUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $currentUser, UserInterface $user)
    {
        //
    }
}
