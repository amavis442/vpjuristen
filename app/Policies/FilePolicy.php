<?php

namespace App\Policies;

use App\Company;
use App\Invoice;
use App\File;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Domain\Contract\UserInterface;

class FilePolicy
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
     * Determine whether the user can view the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function view(UserInterface $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function update(UserInterface $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function delete(UserInterface $user, File $file)
    {
        //
    }

    public function download(UserInterface $user, \App\File $file)
    {
        /** @var Invoice $invoice */
        $invoice = $file->invoice();
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
