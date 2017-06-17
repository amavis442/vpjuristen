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
    public function view(UserInterface $currentUser, UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\Domain\Contract\UserInterface  $currentUser
     * @return mixed
     */
    public function create(UserInterface $currentUser)
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
    public function update(UserInterface $currentUser, UserInterface $user)
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
    public function delete(UserInterface $currentUser, UserInterface $user)
    {
        //
    }
}
