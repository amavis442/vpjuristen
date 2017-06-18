<?php

namespace App\Policies;

use App\Company;
use App\Domain\Contract\UserInterface;
use App\Dossier;
use App\User;
use App\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
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
     * Determine whether the user can view the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function view(UserInterface $user, Invoice $invoice)
    {
        /** @var Dossier $dossier */
        $dossier = $invoice->dossier()->get()->first();
        $clientId = $dossier->client_id;
        /** @var Company $company */
        $company = Company::findOrFail($clientId);
        $companyUser = $company->users()->get()->first();

        if ($companyUser->id == $user->id) {
            return true;
        }

        return false;

    }

    /**
     * Determine whether the user can create invoices.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(UserInterface $user)
    {
        //
    }

    /**
     * Determine whether the user can update the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function update(UserInterface $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can delete the invoice.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return mixed
     */
    public function delete(UserInterface $user, Invoice $invoice)
    {
        //
    }
}
