<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Dossier;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
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
     * Determine whether the user can view the invoice.
     *
     * @param  \App\Models\User    $user
     * @param  \App\Models\Invoice $invoice
     *
     * @return mixed
     */
    public function view(User $user, Invoice $invoice)
    {
        $users = $invoice->dossier()->first()->users()->get()->keyBy('id');
        if ($users->has($user->id)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create invoices.
     *
     * @param  \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the invoice.
     *
     * @param  \App\Models\User    $user
     * @param  \App\Models\Invoice $invoice
     *
     * @return mixed
     */
    public function update(User $user, Invoice $invoice)
    {
        $users = $invoice->dossier()->first()->users()->wherePivot('type', '=', 'client')->get()->keyBy('id');
        if ($users->has($user->id)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the invoice.
     *
     * @param  \App\Models\User    $user
     * @param  \App\Models\Invoice $invoice
     *
     * @return mixed
     */
    public function delete(User $user, Invoice $invoice)
    {
        $users = $invoice->dossier()->first()->users()->wherePivot('type', '=', 'client')->get()->keyBy('id');
        if ($users->has($user->id)) {
            return true;
        }

        return false;
    }

    /**
     * Download invoice file
     */
    public function download(User $user, Invoice $invoice)
    {
        /** @var \Illuminate\Support\Collection $users */
        $users = $invoice->dossier()->first()->users()->wherePivot('type', '=', 'client')->get()->keyBy('id');
        if ($users->has($user->id)) {
            return true;
        }

        return false;
    }
}
