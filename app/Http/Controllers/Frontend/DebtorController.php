<?php

namespace App\Http\Controllers\Frontend;

use App\Debtor;
use App\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!session()->has('client_id')) { // TODO: Maybe put this in a middleware for debtor and dossier.
            \Redirect::route('client-create');
        }

        $debtor = new Debtor();

        return view('debtor.create', ['debtor' => $debtor, 'contactShort' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!session()->has('client_id')) {
            return \Redirect::route('client-create');
        }

        $client_id = session('client_id');

        $debtorData = $request->get('debtor');
        $contactData = $request->get('contact');

        /** @var Debtor $debtor */
        $debtor = Debtor::create(['client_id' => $client_id]);
        /** @var Client $client */
        $client = $debtor->client()->create($debtorData);
        $client->contacts()->create($contactData);

        session('debtor_id', $debtor->id);

        return \Redirect::route('dossier-create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Debtor $debtor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debtor $debtor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debtor $debtor)
    {
        //
    }
}
