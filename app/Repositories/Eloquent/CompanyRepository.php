<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/7/17
 * Time: 5:13 PM
 */

namespace App\Repositories\Eloquent;

use App\Models\Dossier;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function search(string $query = ""): Collection
    {
        return Company::where('company', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->get();
    }

    public function getCompany($type = 'client'): Collection
    {
        $companies = new Collection();

        if ($type == 'client') {
            $companies = Company::with(['dossiers','users','contacts'])->whereHas('dossiers',function($query) {
                $query->where('type' ,'=','client');
            })->get();
        }

        if ($type == 'debtor') {
            $companies = Company::with(['dossiers','users','contacts'])->whereHas('dossiers',function($query) {
                $query->where('type' ,'=','debtor');
            })->get();
        }

        return $companies;
    }


    public function store(Company $company, Request $request)
    {
        $companyData = $request->get('company');
        $company->fill($companyData);
        /** @var Company $company */
        $company->save();

        $userData = $request->get('user');
        $user_id = $userData['id'];
        if ($user_id) {
            $user = User::findOrFail($user_id);
        } else {
            $user = new User();
        }
        $user->fill($userData);
        $user->save();
        $company->users()->sync($user->id, false);

        $contactData = $request->get('contact');
        $contact_id = $contactData['id'];
        if ($contact_id) {
            $contact = Contact::findOrFail(($contact_id));
        } else {
            $contact = new Contact();
        }
        $contact->fill($contactData);
        $contact->save();

        $company->contacts()->sync($contact->id, false);
        $contact->users()->sync($user->id, false);

    }
}