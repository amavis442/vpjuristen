<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        $contact = new Contact();

        return view('frontend.client.create', ['company' => $company, 'contact' => $contact, 'contactShort' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClientFormRequest $request)
    {
        $data = $request->get('company');

        // Create the company
        /** @var Company $company */
        $company = Company::create($data);

        // Create the contact and attach it to the company
        $currentTimestamp = date('Y-m-d H:i:s');;
        $data = $request->get('contact');
        $data['created_at'] = $currentTimestamp;
        $data['created_at'] = $currentTimestamp;
        /** @var Contact $contact */
        $contact = $company->contacts()->create($data);

        // Create a new user for the contact so he/she can login in
        $userData = [];
        $userData['name'] = $contact->name;
        $userData['email'] = $contact->email;
        $userData['password'] = bcrypt('secret');
        $userData['active'] = 1;
        $userData['status'] = 'pending';
        $userData['created_at'] = $currentTimestamp;
        $userData['updated_at'] = $currentTimestamp;

        /** @var User $user */
        $user = $company->users()->withTimestamps()->create($userData);

        // Give the user a role so he/she can login in with restrictions
        $user->roles()->withTimestamps()->attach(Role::where(['name' => 'prospect'])->get()->first()->id);

        // Attach the user to the contact
        $contact->users()->withTimestamps()->attach($user->id);

        // Store the company id for the next step
        session(['client_id' => $company->id]);

        return \Redirect::route('frontend.register.debtor.create');
    }
}
