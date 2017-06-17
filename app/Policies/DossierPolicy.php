<?php

namespace App\Policies;

use App\Domain\Contract\UserInterface;
use App\User;
use App\Dossier;
use Illuminate\Auth\Access\HandlesAuthorization;

class DossierPolicy
{
    use HandlesAuthorization;

    public function before(UserInterface $user, $ability)
    {
        // Admin and employee may see always
        if ($user->hasRole('admin') || $user->hasRole('employee')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the dossier.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function view(UserInterface $user, Dossier $dossier)
    {
        //
    }

    /**
     * Determine whether the user can create dossiers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can update the dossier.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function update(UserInterface $user, Dossier $dossier)
    {
        //
    }

    /**
     * Determine whether the user can delete the dossier.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function delete(UserInterface $user, Dossier $dossier)
    {
        //
    }
}
