<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Contact;
use App\Domain\Repository\EloquentDossiersRepository;
use App\Domain\Services\Dossier\DossierService;
use App\Listaction;
use App\Role;
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
        $dossiers = Dossier::where('dossierstatus_id', '=', 1)->get()->all();
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
     * @param  \Illuminate\Http\Request $request
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $totalSom = 0;
        $receivedSom = 0;
        $paidSom = 0;
        $remaining = 0;
        $interest = 0;

        $this->dossierService->setDossierId($id);
        /** @var Dossier $dossier */
        $dossier = $this->dossierService->getDossier($id);
        /** @var \App\Dossierstatus $dossierStatus */
        $dossierStatus = $dossier->dossierstatus()->first();

        /** @var \App\Invoice[] $invoices */
        $invoices = $dossier->invoices()->get();
        foreach ($invoices as $invoice) {
            $totalSom += $invoice->amount;
        }
        $remaining = $totalSom;

        /** @var \App\Company $client */
        $client = $dossier->client()->first();
        /** @var \App|Contact $clientContact */
        $clientContact = $client->contacts()->first();
        /** @var \App\Company $debtor */
        $debtor = $dossier->debtor()->first();
        /** @var \App|Contact $debtorContact */
        $debtorContact = $debtor->contacts()->first();

        $clientRoleId = Role::where('name','=','client')->first()->id;
        $debtorRoleId = Role::where('name','=','debtor')->first()->id;

        /** @var \App\Comment[] $comments */
        $comments = $dossier->comments()->get();
        /** @var \App\Action[] $actions */
        $actions = $dossier->actions()->get();
        foreach ($actions as $action) {
            $actionRoles = $action->roles();

            $clientCanSee = !is_null($actionRoles->get(['role_id'])
                ->where('role_id','=', $clientRoleId)->first()) ? true: false;

            $debtorCanSee = !is_null($actionRoles->get(['role_id'])
                ->where('role_id','=', $debtorRoleId)->first()) ? true: false;

           $collect =  $action->collection()->get()->first();
            if ($collect) {
                $action->amount = $collect->amount;
            } else{
                $action->amount = '-';
            }

            $action->clientCanSee = $clientCanSee;

            $action->debtorCanSee = $debtorCanSee;

            /** @var Listaction $listactionItem */
            $listactionItem = $action->listaction()->get()->first();
            if ($listactionItem->description == 'betaling ontvangen' || $listactionItem->description == 'deelbetaling ontvangen') {
                $receivedSom += $action->collection()->get()->first()->amount;

            }

            if ($listactionItem->description == 'betaling uitgekeerd' || $listactionItem->description == 'deelbetaling uitgekeerd') {
                $paidSom += $action->collection()->get()->first()->amount;
            }
        }

        $remaining -= $receivedSom;

        return view('admin.dossier.view', [
            'dossier' => $dossier,
            'dossierStatus' => $dossierStatus,
            'invoices' => $invoices,
            'client' => $client,
            'clientContact' => $clientContact,
            'debtor' => $debtor,
            'debtorContact' => $debtorContact,
            'actions' => $actions,
            'comments' => $comments,
            'totalSom' => $totalSom,
            'receivedSom' => $receivedSom,
            'paidSom' => $paidSom,
            'remainingSom' => $remaining,
            'interestSom' => $interest
        ]);
    }

    public function list($id, Request $request)
    {
        $company = Company::find($id);
        $dossiers = $company->dossiers()->get();

        $returnUrl = back()->getTargetUrl();

        return view('admin.dossier.list', ['returnUrl' => $returnUrl, 'company' => $company, 'dossiers' => $dossiers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(EloquentDossiersRepository $repository)
    {
        $dossiers = $repository->search(request('q'));
        return view('admin.dossier.index', ['dossiers' => $dossiers]);
    }
}
