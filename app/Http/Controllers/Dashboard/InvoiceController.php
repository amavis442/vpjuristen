<?php

namespace App\Http\Controllers\Dashboard;

use App\Domain\Services\Dossier\DossierService;
use App\Http\Controllers\InvoiceAjaxTrait;
use App\Repositories\Eloquent\DossierRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    use InvoiceAjaxTrait;

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
        $dossierService = new DossierService(new DossierRepository());
        return $dossierService->downloadInvoice($invoice_id);
    }
}
