<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
     * Determine whether the user can view the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return mixed
     */
    public function view(User $user, Company $company)
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
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        /** @var User $companyUser */
        $companyUser = $company->users()->get()->first();

        if ($user->id == $companyUser->id) {
            return true;
        }

        return false;
    }

    public function edit(User $user, Company $company)
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
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        return false;
    }
}
