<?php

namespace App\Http\Controllers\Frontend;

use App\Company;
use App\Dossier;
use App\Invoice;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* if (!session()->has('client_id') || !session()->has('debtor_id')) {
            \Redirect::route('frontend.dossier-create');
        } */

        $dossier = $request->get('dossier');
        $currentTimestamp = date('Y-m-d H:i:s');

        $client_id = session('client_id', 5);
        /** @var Company $company */
        $company = Company::findOrFail($client_id);

        $data['debtor_id'] = session('debtor_id', 6);
        $data['title'] = $dossier['name'];
        $data['dossierstatus_id'] = 1;
        $data['created_at'] = $currentTimestamp;
        $data['updated_at'] = $currentTimestamp;
        /** @var Dossier $dossier */
        $dossier = $company->dossiers()->withTimestamps()->create($data);

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

        return \Redirect::route('frontend.register.thankyou');
    }

    public function imageUploadPost(Request $request)
    {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('success', 'Image Uploaded successfully.')
            ->with('path', $imageName);

    }

    public function ajaxAddInvoice()
    {
        return view('common.invoice.form');
    }


    public function thankyou(Request $request)
    {
        return view('frontend.dossier.thankyou');
    }
}
