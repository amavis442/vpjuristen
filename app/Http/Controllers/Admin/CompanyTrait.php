<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/11/17
 * Time: 11:41 PM
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;



trait CompanyTrait
{


    public function createCompany()
    {
        if (!$this->authorize('create', Company::class)) {
            return redirect()->route('admin.home');
        }

        $user         = new User();
        $contact      = new Contact();
        $contactShort = false;

        return compact('user', 'contact', 'contactShort');
    }

    public function storeCompany(Request $request)
    {
        if (!$this->authorize('create', Company::class)) {
            return redirect()->route('admin.home');
        }

        \Validator::validate($request->get('company'), Company::RULES);
        \Validator::validate($request->get('contact'), Contact::RULES);


        $company = new Company();
        $company->fill($request->get('company'));
        $company->save();

        $contact = new Contact();
        $contact->fill($request->get('company'));
        $contact->save();

        $company->contacts()->attach($contact->id);
    }

    public function showCompany(Company $company)
    {
        $contact = $company->contacts()->first();
        $user    = $contact->users()->first();

        return compact('company', 'contact', 'user');
    }

    public function editCompany(Company $company)
    {
        /** @var \App\Models\Company $company */
        if (!$this->authorize('edit', $company)) {
            return redirect()->route('admin.home');
        }

        $contact = $company->contacts()->first();
        $user    = $company->users()->get()->first();
        if (is_null($user)) {
            $user = new User();
        }

        $contactShort = false;
        $statuses = User::STATUS;

        return compact('company', 'contact', 'user', 'contactShort','statuses');
    }

    public function updateCompany(Request $request)
    {
        if (!$this->authorize('edit', Company::class)) {
            return redirect()->route('admin.home');
        }

        \Validator::validate($request->get('company'), Company::RULES);
        \Validator::validate($request->get('contact'), Contact::RULES);

        if ($request->get('user')['password'] <> '') {
            $userRules = User::RULES;
        } else {
            $userRules= ['name' => 'required|string|max:255','email'=>'required|string|email|max:255'];
        }
        \Validator::validate($request->get('user'), $userRules);


        $company = Company::findOrFail($request->get('company')['id']);
        $company->fill($request->get('company'));
        $company->save();

        $contact = Contact::findOrFail($request->get('contact')['id']);
        $contact->fill($request->get('contact'));
        $contact->save();

        $user = User::findOrFail($request->get('user')['id']);
        $user->fill($request->get('user'));
        $user->password = bcrypt($request->get('user')['password']);
        $user->save();
    }
}