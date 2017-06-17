<?php

namespace App\Policies;

use App\Domain\Contract\UserInterface;
use App\User;
use App\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
     * Determine whether the user can view the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(UserInterface $user, Company $company)
    {
        /** @var User $companyUser */
        $companyUser = $company->users()->get()->first();

        if ($user->id == $companyUser->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(UserInterface $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function update(UserInterface $user, Company $company)
    {
        /** @var User $companyUser */
        $companyUser = $company->users()->get()->first();

        if ($user->id == $companyUser->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        return false;
    }
}
