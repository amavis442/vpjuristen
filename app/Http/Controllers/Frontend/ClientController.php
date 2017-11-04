<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CompanyAndContactRequest;
use App\Models\Contact;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;

class ClientController extends Controller
{

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }


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
     * @param CompanyAndContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyAndContactRequest $request)
    {
        $data['company'] = $request->get('company');
        $data['contact'] = $request->get('contact');

        $company = $this->companyService->createWithContactAndUser($data);

        // Store the company id for the next step
        session(['client_id' => $company->id]);

        return \Redirect::route('frontend.debtor.create');
    }
}
