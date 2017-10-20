<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;


class DebtorController extends Controller
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
        if (!session()->has('client_id')) { // TODO: Maybe put this in a middleware for debtor and dossier.
            \Redirect::route('frontend.client.create');
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
            return \Redirect::route('frontend.client.create');
        }


        $data['company'] = $request->get('company');
        $data['contact'] = $request->get('contact');

        $company = $this->companyService->createWithContactAndUser($data);

        session(['debtor_id' => $company->id]);

        return \Redirect::route('frontend.dossier.create');
    }

    public function show(Company $company) {

    }
}
