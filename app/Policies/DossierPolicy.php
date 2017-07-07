<?php

namespace App\Policies;

use App\Models\Company;
use App\Domain\Contract\UserInterface;
use App\Models\User;
use App\Models\Dossier;
use Illuminate\Auth\Access\HandlesAuthorization;

class DossierPolicy
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
     * Determine whether the user can view the dossier.
     *
     * @param  \App\User  $user
     * @param  \App\Dossier  $dossier
     * @return mixed
     */
    public function view(User $user, Dossier $dossier)
    {
        $users = $dossier->users()->withPivot('type')->get();
        foreach ($users as $testuser){
            if ($testuser->pivot->type == 'client') {
                if ($user->id == $testuser->id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the user can create dossiers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
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
    public function update(User $user, Dossier $dossier)
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
    public function delete(User $user, Dossier $dossier)
    {
        //
    }
}
