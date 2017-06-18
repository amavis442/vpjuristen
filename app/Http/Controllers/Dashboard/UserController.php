<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Contact;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:dashboard');
    }

    public function index()
    {
        $company = Auth::user()->companies()->first();
        $contact = $company->contacts()->first();

        //Todo: change view to readonly if you only want to view your data.
        return view('dashboard.user.edit', ['contact' => $contact, 'company' => $company, 'contactShort' => false]);
    }

    public function edit(Request $request)
    {
        $company = Auth::user()->companies()->first();
        $contact = $company->contacts()->first();

        return view('dashboard.user.edit', ['contact' => $contact, 'company' => $company, 'contactShort' => false]);
    }

    public function store(Request $request)
    {
        /** @var Company $company */
        $company = Auth::user()->companies()->first();
        /** @var Contact $contact */
        $contact = $company->contacts()->first();

        $data = $request->get('company');
        unset($data['id']);
        $company->update($data);
        $data = $request->get('contact');
        unset($data['id']);
        unset($data['company_id']);
        $contact->update($data);

        //Todo: Also add this one to a job for notification
        return \Redirect::route('dashboard.home');
    }
}
