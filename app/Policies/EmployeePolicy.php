<?php

namespace App\Policies;

use App\Models\User;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user, User $employee)
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, User $employee)
    {
        //
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user, User $employee)
    {
        //
    }
}
