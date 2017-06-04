<?php

namespace App\Http\Controllers\Dashboard;

use App\Domain\Services\Dossier\DossierService;
use App\Http\Controllers\InvoiceAjaxTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dossier;
use App\Invoice;

class InvoiceController extends Controller
{
    use InvoiceAjaxTrait;

    public function __construct()
    {
        $this->middleware('auth:dashboard');
    }

    //
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('client')) {
            $dossiers = $user->companies()->first()->dossiers()->get();
        }

        return view('dashboard.dossier.index', ['dossiers' => $dossiers]);
    }

    public function edit(Request $request)
    {
        $dossierid = $request->get('id');
        $invoiceid = $request->get('invoiceid');

        $user = Auth::user();
        $dossier = Dossier::findOrFail($dossierid);
        // checken of user wel bij deze gebruiker hoort
        $dossier = $user->companies()
            ->first()
            ->dossiers()
            ->findOrFail($dossierid);

        $invoice = $dossier->invoices()->findOrFail($invoiceid);

        return view('common.invoice.form', ['add' => true, 'index' => 1, 'invoice' => $invoice]);
    }

    public function downloadFile($invoice_id, Request $request)
    {
        $dossierService = new DossierService();
        return $dossierService->downloadInvoice($invoice_id);
    }
}
