<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Services\Dossier\DossierService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dossier;

class DossierController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dossiers = Dossier::where('dossierstatus_id','=',1)->get()->all();
        return view('admin.dossier.index', ['dossiers' => $dossiers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dossierService = new \App\Domain\Services\Dossier\DossierService();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->dossierService->setDossierId($id);
        /** @var Dossier $dossier */
        $dossier = $this->dossierService->getDossier($id);
        $invoices = $dossier->invoices();
        $client = $dossier->client();
        $debtor = $dossier->debtor();
        $comments = $dossier->comments();

        return view('admin.dossier.view', ['dossier' => $dossier, 'invoices' => $invoices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
