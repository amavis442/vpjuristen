<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
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
     * Determine whether the user can view the contact.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $contact
     * @return mixed
     */
    public function view(User $user, Contact $contact)
    {
        //
    }

    /**
     * Determine whether the user can create contacts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the contact.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $contact
     * @return mixed
     */
    public function update(User $user, Contact $contact)
    {
        //
    }

    /**
     * Determine whether the user can delete the contact.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $contact
     * @return mixed
     */
    public function delete(User $user, Contact $contact)
    {
        //
    }
}
