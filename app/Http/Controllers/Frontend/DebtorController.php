<?php

namespace App\Http\Controllers\Frontend;

use App\Company;
use App\Contact;
use App\Debtor;
use App\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebtorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!session()->has('client_id')) { // TODO: Maybe put this in a middleware for debtor and dossier.
            \Redirect::route('frontend.register.client.create');
        }

        $company = new Company();
        $contact = new Contact();

        return view('frontend.debtor.create', ['company' => $company, 'contact' => $contact, 'contactShort' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!session()->has('client_id')) {
            return \Redirect::route('frontend.register.client.create');
        }
        $currentTimestamp = date('Y-m-d H:i:s');;

        $data = $request->get('company');
        /** @var Company $company */
        $company = Company::create($data);

        $data = $request->get('contact');
        $data['created_at'] = $currentTimestamp;
        $data['created_at'] = $currentTimestamp;
        $company->contacts()->create($data);

        session('debtor_id', $company->id);

        return \Redirect::route('frontend.register.dossier.create');

    }
}
