<?php

namespace App\Http\Controllers\Frontend;

use App\Dossier;
use App\Invoice;
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
        $invoice = new Invoice();

        return view('frontend.dossier.create', ['dossier' => $dossier, 'invoice' => $invoice, 'index' => 1]);
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
            \Redirect::route('dossier-create');
        } */

        $dossier = $request->get('dossier');

        $data['client_id'] = session('client_id', 1);
        $data['debtor_id'] = session('debtor_id', 1);
        $data['title'] = $dossier['name'];
        /** @var Dossier $dossier */
        $dossier = Dossier::create($data);


        $this->validate($request, [
            'doc' => 'file|mimes:pdf,doc,docx,jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $invoices = $request->get('invoice');
        $numInvoices = count($invoices);
        for ($i = 1; $i <= $numInvoices; $i++) {
            $doc = $request->file('invoice_' . $i . '_file');
            $filename = $doc->store('invoices');

            $invoice['title'] = $invoices[$i]['title'];
            $invoice['dossier_id'] = $dossier->id;
            $invoice['amount'] = $invoices[$i]['amount'];
            $invoice['due_date'] = $invoices[$i]['due_date'];
            $invoice['file'] = $filename;
            $invoice['remarks'] = $invoices[$i]['remarks'];
            Invoice::create($invoice);
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
