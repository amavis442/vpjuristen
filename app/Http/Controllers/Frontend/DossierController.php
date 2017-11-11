<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use App\Models\Dossier;
use App\Models\Invoice;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DossierController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dossier = new Dossier;
        $invoices = new ArrayCollection([new Invoice()]);
        session(['numInvoices' => 0]);
        return view('frontend.dossier.create', ['dossier' => $dossier, 'invoices' => $invoices, 'prefix'=>'frontend']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!session()->has('client_id') || !session()->has('debtor_id')) {
            if (!session()->has('client_id')) {
                \Redirect::route('frontend.client.create');
            }
            if (!session()->has('debtor_id')) {
                \Redirect::route('frontend.debtor.create');
            }
        }

        $rules = array_merge(Dossier::RULES, Invoice::RULES);
        $this->validate($request, $rules);

        $dossier = $request->get('dossier');
        $currentTimestamp = date('Y-m-d H:i:s');

        // Get the client ID and verify that the company exists
        $client_id = session('client_id', null);
        /** @var Company $company */
        $clientCompany = Company::findOrFail($client_id);
        $data['client_id'] = $clientCompany->id;

        // Get the debtor ID and verify that the company exists
        $debtor_id = session('debtor_id', null);
        $debtorCompany = Company::findOrFail($debtor_id);
        $data['debtor_id'] = $debtorCompany->id;

        // Create the dossier
        $data['title'] = $dossier['title'];
        $data['dossierstatus_id'] = 1;
        $data['created_at'] = $currentTimestamp;
        $data['updated_at'] = $currentTimestamp;
        /** @var Dossier $dossier */
        $dossier = Dossier::create($data);

        $dossier->companies()->attach($clientCompany->id);
        $dossier->companies()->attach($debtorCompany->id);

        // Create the invoices and attach it to the dossier
        $this->validate($request, [
            'doc' => 'file|mimes:pdf,doc,docx,jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $invoices = $request->get('invoice');
        $numInvoices = count($invoices);
        for ($i = 0; $i < $numInvoices; $i++) {
            $invoice['title'] = $invoices[$i]['title'];
            $invoice['dossier_id'] = $dossier->id;
            $invoice['amount'] = $invoices[$i]['amount'];
            $invoice['due_date'] = $invoices[$i]['due_date'];

            $invoice['remarks'] = $invoices[$i]['remarks'];
            /** @var Invoice $invoice */
            $invoice = Invoice::create($invoice);

            $doc = $request->file('invoice_' . $i . '_file');
            if (!is_null($doc)) {
                $filename = $doc->store('invoices');
                $filename_org = $doc->getClientOriginalName();
                $invoice->files()->withTimestamps()->create(['filename' => $filename, 'filename_org' => $filename_org]);
            }
        }

        return \Redirect::route('frontend.dossier.thankyou');
    }

    public function thankyou(Request $request)
    {
        return view('frontend.dossier.thankyou');
    }
}
