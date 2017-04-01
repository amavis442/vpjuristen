<?php

namespace App\Http\Controllers\Frontend;

use App\Client;
use App\Contact;
use App\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientFormRequest;
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

        return view('frontend.client.create', ['company' => $company,'contact' => $contact, 'contactShort' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientFormRequest $request)
    {

        $data = $request->get('company');
        /** @var Company $company */
        $company = Company::create($data);
        $client = Client::create(['company_id' => $company->id]);

        $data = $request->get('contact');
        $data['company_id'] = $company->id;
        $company->contacts()->create($data);

        session(['client_id' => $client->id]);
        
        return \Redirect::route('frontend.register.debtor.create');
    }
}
