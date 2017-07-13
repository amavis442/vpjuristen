<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
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
     * Determine whether the user can view the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function view(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        //
    }

    public function download(User $user, \App\Models\File $file)
    {
        /** @var Invoice $invoice */
        $invoice = $file->invoices()->get()->first();
        $dossier = $invoice->dossier()->get()->first();
        $clientId = $dossier->client_id;
        /** @var Company $company */
        $company = Company::findOrFail($clientId);
        $companyUser = $company->users()->get()->first();

        if ($companyUser->id == $user->id) {
            return true;
        }
    }
}
