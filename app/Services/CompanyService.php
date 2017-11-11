<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Role;

class CompanyService
{
    public function __construct()
    {
    }

    public function createWithContactAndUser(array $data)
    {
        if (!array_has($data, 'company')) {
            throw new \RuntimeException('No company index provided.');
        }
        if (!array_has($data, 'contact')) {
            throw new \RuntimeException('No contact for company index provided.');
        }

        /** @var Company $company */
        $company = Company::create($data['company']);

        // Create the \App\Models\Contact and attach it to the company
        $currentTimestamp = date('Y-m-d H:i:s');;
        $data['contact']['created_at'] = $currentTimestamp;

        /** @var \App\Models\Contact $contact */
        $contact = $company->contacts()->create($data['contact']);

        // Create a new user for the contact so he/she can login in
        $userData = [];
        $userData['name'] = $contact->name;
        $userData['email'] = $contact->email;
        $userData['password'] = bcrypt('secret');
        $userData['active'] = 0;
        $userData['status'] = 'pending';
        $userData['created_at'] = $currentTimestamp;
        $userData['updated_at'] = $currentTimestamp;
        $userData['role'] = 'user';
        $userData['status'] = 'pending';

        /** @var \App\Models\User $user */
        $user = $company->users()->create($userData);

        // Attach the user to the contact
        $contact->users()->attach($user->id);

        return $company;
    }

}